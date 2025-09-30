<?php

namespace App\Http\Controllers\clients;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\CheckOut;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(string $id)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt tour.');
        }
        $user = Auth::user();
        $tour = Tour::with(['images', 'thumbnail', 'timelines'])->where('tourId', $id)->first();
        $title = "Booking -  $tour->title";

        return view('clients.booking', compact('tour', 'user', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tourId' => 'required|exists:tbl_tour,tourId',
            'userId' => 'required|exists:tbl_users,userId',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'tel' => 'required|string',
            'dia_chi' => 'required|string',
            'numAdults' => 'required|integer|min:1',
            'numChildren' => 'required|integer|min:0',
            'totalPrice' => 'required|numeric|min:0',
            'payment' => 'required|in:office-payment',
            'agree' => 'required|accepted'
        ]);
        try {
            // Tạo booking
            $booking = Booking::create([
                'tourId' => $request->tourId,
                'userId' => $request->userId,
                'bookingDate' => now(),
                'numAdults' => $request->numAdults,
                'numChildren' => $request->numChildren,
                'totalPrice' => $request->totalPrice,
                'fullname' => $request->username,
                'email' => $request->email,
                'phone' => $request->tel,
                'address' => $request->dia_chi,
                'bookingStatus' => 'pending',

            ]);
            // Cập nhật số lượng tour còn lại
            $tour = Tour::where('tourId', $request->tourId)->first();
            if ($tour) {
                $totalBooked = $request->numAdults + $request->numChildren;
                $tour->quantity = $tour->quantity - $totalBooked;
                $tour->save();
            }
            $bookingId = $booking->bookingId;
            // Tạo checkout record cho thanh toán tại văn phòng         
            CheckOut::create([

                'bookingId' => $bookingId,
                'paymentMethod' => $request->payment,
                'paymentDate' => null, // Sẽ cập nhật khi thanh toán
                'amount' => $request->totalPrice,
                'paymentStatus' => 'pending',
                'transactionId' => null,
            ]);

            return redirect()->route('tour-detail', $request->tourId)
                ->with('success', 'Đặt tour thành công! Vui lòng đến văn phòng để thanh toán.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with(['error' => 'Có lỗi xảy ra khi đặt tour. Vui lòng thử lại.']);
        }
    }

    public function success($bookingId)
    {
        $booking = Booking::where('bookingId', $bookingId)->firstOrFail();
        $tour = Tour::find($booking->tourId);
        $checkout = CheckOut::where('bookingId', $bookingId)->first();

        return view('booking.success', compact('booking', 'tour', 'checkout'));
    }


    public function history(Request $request)
    {
        $title = "Lịch sử đặt tour";
        $user = Auth::user();

        $query = Booking::with(['tour', 'checkout'])
            ->where('userId', $user->userId);

        // Lọc theo khoảng ngày startDate của Tour
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->whereDate('startDate', '>=', $request->startDate)
                    ->whereDate('startDate', '<=', $request->endDate);
            });
        } elseif ($request->filled('startDate')) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->whereDate('startDate', '>=', $request->startDate);
            });
        } elseif ($request->filled('endDate')) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->whereDate('startDate', '<=', $request->endDate);
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('bookingStatus', $request->status);
        }

        // Lọc theo tên tour
        if ($request->filled('title')) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->title . '%');
            });
        }

        $historys = $query->orderBy('bookingDate', 'desc')->get();

        // Lấy trạng thái duy nhất cho select option
        $bookingStatus = Booking::where('userId', $user->userId)
            ->pluck('bookingStatus')
            ->unique()
            ->toArray();

        return view('clients.history-booking', compact('title', 'historys', 'bookingStatus'));
    }


    public function cancelBooking($id)
    {
        $booking = Booking::where('bookingId', $id)->firstOrFail();

        // Kiểm tra nếu booking đã được xác nhận hoặc hoàn thành thì không thể hủy
        if ($booking->bookingStatus != 'pending') {
            return redirect()->back()->with('error', 'Chỉ có thể hủy các đặt tour đang chờ xử lý.');
        }

        // Cập nhật trạng thái booking thành 'canceled'
        $booking->bookingStatus = 'cancelled';
        $booking->save();

        // Cập nhật số lượng tour trở lại
        $tour = Tour::where('tourId', $booking->tourId)->first();
        if ($tour) {
            $totalBooked = $booking->numAdults + $booking->numChildren;
            $tour->quantity += $totalBooked;
            $tour->save();
        }
        
        $checkout = CheckOut::where('bookingId', $id)->first();
        $checkout->paymentStatus = 'cancelled';
        $checkout->save();

        return redirect()->back()->with('success', 'Tour đã được hủy thành công.');
    }
}
