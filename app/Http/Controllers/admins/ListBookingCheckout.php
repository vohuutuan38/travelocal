<?php

namespace App\Http\Controllers\admins;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListBookingCheckout extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // Lấy số liệu thống kê
    $stats = [
        'total' => Booking::count(),
        'pending' => Booking::where('bookingStatus', 'Pending')->count(),
        'confirmed' => Booking::where('bookingStatus', 'Confirmed')->count(),
        'completed' => Booking::where('bookingStatus', 'Completed')->count(),
    ];

    // ... (Phần query lọc và tìm kiếm giữ nguyên)
   $query = Booking::with(['tour.thumbnail', 'user', 'checkout']) // <-- Đã cập nhật
                    ->latest('bookingDate');

    if ($request->filled('status')) {
        $query->where('bookingStatus', $request->status);
    }
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('fullname', 'like', "%{$searchTerm}%")
                ->orWhereHas('tour', function ($tourQuery) use ($searchTerm) {
                    $tourQuery->where('title', 'like', "%{$searchTerm}%");
                });
        });
    }

    $bookings = $query->paginate(10)->withQueryString();

    // Truyền cả $bookings và $stats sang view
    return view('admins.booking-tour.index', compact('bookings', 'stats'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['tour.thumbnail', 'user', 'checkout']);
        return view('admins.booking-tour.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'bookingStatus' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $booking->update(['bookingStatus' => $request->bookingStatus]);

        return redirect()->route('admin.showBooking', $booking)->with('success', 'Cập nhật trạng thái booking thành công!');
    }

    /**
     * Xóa một booking.
     */
    public function destroy(Booking $booking)
    {
      $booking->delete(); // Tự động xóa mềm do đã khai báo trait SoftDeletes
        return redirect()->route('admin.listBooking')->with('success', 'Đã chuyển booking vào thùng rác!');
    }

     public function trash()
    {
        $trashedBookings = Booking::onlyTrashed()->with(['tour', 'user'])->latest('deleted_at')->paginate(10);
        return view('admins.booking-tour.trash', compact('trashedBookings'));
    }

    /**
     * (MỚI) Khôi phục một booking từ thùng rác.
     */
    public function restore(Booking $booking)
    {
        $booking->restore();
        return redirect()->route('admin.trashBooking')->with('success', 'Khôi phục booking thành công!');
    }
}
