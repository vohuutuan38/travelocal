<?php

namespace App\Http\Controllers\clients;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faqs;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Tour";
        $tours = Tour::with(['images', 'thumbnail'])->paginate(9);

        return view('clients.tour', compact('title', 'tours'));
    }

    public function search(Request $request)
    {
        $title = "TÌm kiếm";
        $tourSearch = $request->title;
        $tours = Tour::with(['images', 'thumbnail'])->where('title', 'like', '%' . $tourSearch . '%')->paginate(9);
        return view('clients.tour', compact('title', 'tours'));
    }
    public function filter(Request $request)
    {
        $title = "Tour";

        $query = Tour::with(['images', 'thumbnail']);

        // Lọc theo giá
        if ($request->min_price && $request->max_price) {
            $query->whereBetween('priceAdult', [$request->min_price, $request->max_price]);
        }

      // Lọc theo điểm đến (domain b, t, n) - ĐÃ SỬA
    if ($request->filled('domain')) {
        // Dùng whereHas để lọc qua relationship 'city'
        $query->whereHas('city', function ($cityQuery) use ($request) {
            $cityQuery->where('domain', $request->domain);
        });
    }


        // Lọc theo sao (review >= x)
        if ($request->star) {
            $query->where('review', '>=', $request->star);
        }

        // Lọc theo thời gian (ví dụ: 3n2d, 4n3d, …)
        if ($request->time) {
            $query->where('time', $request->time);
        }

        $tours = $query->paginate(9);

        return view('clients.tour', compact('title', 'tours'));
    }

    public function booking(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt tour.');
        }
        $user = Auth::user();
        $tour = Tour::with(['images', 'thumbnail', 'timelines'])->where('tourId', $id)->first();
        $title = "Booking - " . $tour->title;
        return view('clients.booking', compact('title', 'tour', 'user'));
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
    public function show(string $id)
    {
        $user = Auth::user();
        $hasPendingBooking = false;
        if ($user) {
            $hasPendingBooking = Booking::where('userId', $user->userId)
                ->where('tourId', $id)
                ->where('bookingStatus', 'pending')
                ->exists();
        }
        $tour = Tour::with(['images', 'thumbnail', 'timelines', 'includes', 'excludes', 'activities', 'locationMap', 'city'])->where('tourId', $id)->first();
        $title = $tour->title;
        $faqs = Faqs::all();

        $reviews = $tour->reviews()->with('user')->latest()->paginate(5);

        // Tính toán các chỉ số thống kê
        $reviewCount = $tour->reviews()->count();
        $reviewStats = null;
        if ($reviewCount > 0) {
            $reviewStats = [
                'total' => $reviewCount,
                'overall_avg' => round($tour->reviews()->avg('average'), 1),
                'service_avg' => round($tour->reviews()->avg('service')),
                'food_avg' => round($tour->reviews()->avg('food')),
                'price_avg' => round($tour->reviews()->avg('price')),
                'hotel_avg' => round($tour->reviews()->avg('hotel')),
            ];
        }
        return view('clients.tour-detail', compact('title', 'tour', 'hasPendingBooking', 'faqs','reviews', 'reviewStats'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
