<?php

namespace App\Http\Controllers\admins;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ListReviewController extends Controller
{
      public function index(Request $request)
    {
        // dd('hahaaha');
        // --- Phần thống kê ---
        $stats = [
            'total' => Review::count(),
            'avg_rating' => round(Review::avg('average'), 1),
            'distribution' => Review::query()
                ->select('average', DB::raw('count(*) as count'))
                ->groupBy('average')
                ->orderBy('average', 'desc')
                ->pluck('count', 'average'),
        ];

        // --- Phần danh sách ---
        $query = Review::with(['user', 'tour'])->latest();

        // Lọc theo rating
        if ($request->filled('rating')) {
            $query->where('average', $request->rating);
        }

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($userQuery) => $userQuery->where('fullname', 'like', "%{$search}%"))
                    ->orWhereHas('tour', fn($tourQuery) => $tourQuery->where('title', 'like', "%{$search}%"));
            });
        }

        $reviews = $query->paginate(10)->withQueryString();

        return view('admins.review.index', compact('reviews', 'stats'));
    }

    /**
     * Xóa mềm một đánh giá.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Đã chuyển đánh giá vào thùng rác.');
    }

    /**
     * Hiển thị thùng rác.
     */
    public function trash()
    {
        $trashedReviews = Review::onlyTrashed()->with(['user', 'tour'])->latest('deleted_at')->paginate(10);
        return view('admins.review.trash', compact('trashedReviews'));
    }

    /**
     * Khôi phục một đánh giá.
     */
    public function restore(Review $review)
    {
        $review->restore();
        return redirect()->route('admin.trashReview')->with('success', 'Khôi phục đánh giá thành công.');
    }
}
