<?php

namespace App\Http\Controllers\clients;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
     public function store(Request $request, Tour $tour)
    {
        // 1. Validate dữ liệu gửi lên
        $validated = $request->validate([
            'service' => 'required|integer|min:1|max:5',
            'food' => 'required|integer|min:1|max:5',
            'price' => 'required|integer|min:1|max:5',
            'hotel' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        // 2. Logic nghiệp vụ: Chỉ user đã đi tour và chưa đánh giá mới được quyền
        $canReview = Auth::user()->bookings()
                            ->where('tourId', $tour->tourId)
                            ->where('bookingStatus', 'completed')
                            ->exists();
// dd($canReview);

        $hasReviewed = $tour->reviews()->where('userId', Auth::id())->exists();

        if (!$canReview || $hasReviewed) {
            return back()->with('error', 'Bạn không thể đánh giá tour này hoặc đã đánh giá trước đó.');
        }

        // 3. Tính điểm trung bình (làm tròn thành số nguyên)
        $average = round(
            ($validated['service'] + $validated['food'] + $validated['price'] + $validated['hotel']) / 4
        );
        
        // 4. Tạo đánh giá mới
        $tour->reviews()->create([
            'userId' => Auth::id(),
            'service' => $validated['service'],
            'food' => $validated['food'],
            'price' => $validated['price'],
            'hotel' => $validated['hotel'],
            'comment' => $validated['comment'],
            'average' => $average, // Lưu điểm trung bình đã làm tròn
        ]);

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá!');
    }
}
