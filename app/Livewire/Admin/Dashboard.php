<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Tour;
use App\Models\User;
use App\Models\Guide;
use App\Models\Review;
use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $period = 'last_30_days'; // Giá trị mặc định cho bộ lọc biểu đồ

    // Phương thức này được gọi khi component được tải lần đầu
    public function mount()
    {
        $this->loadChartData();
    }

    // Cập nhật biểu đồ khi người dùng thay đổi bộ lọc
    public function updatedPeriod()
    {
        $this->loadChartData();
    }

    // Tải dữ liệu cho biểu đồ và gửi sự kiện tới trình duyệt
    public function loadChartData()
    {
        $data = $this->getRevenueData();
        // Gửi sự kiện 'updateChart' tới JavaScript với dữ liệu mới
        $this->dispatch('updateChart', data: $data);
    }

    // Lấy các số liệu thống kê cho các thẻ card
    private function getStats()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        return [
            'totalRevenue' => Booking::where('bookingStatus', 'Completed')->sum('totalPrice'),
            'totalBookings' => Booking::count(),
            'newUsersThisMonth' => User::where('created_at', '>=', $startOfMonth)->count(),
            'totalTours' => Tour::count(),
        ];
    }

    // Lấy dữ liệu doanh thu theo khoảng thời gian đã chọn
    private function getRevenueData()
    {
        $endDate = Carbon::now();
        $startDate = match ($this->period) {
            'last_7_days' => $endDate->copy()->subDays(6),
            'last_30_days' => $endDate->copy()->subDays(29),
            'last_60_days' => $endDate->copy()->subDays(59),
            default => $endDate->copy()->subDays(29),
        };

        $revenue = Booking::select(
            DB::raw('DATE(bookingDate) as date'),
            DB::raw('SUM(totalPrice) as total')
        )
            ->whereBetween('bookingDate', [$startDate, $endDate])
            ->where('bookingStatus', 'completed')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $dates = [];
        $totals = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $dates[] = $currentDate->format('d/m');
            $revenueOnDay = $revenue->firstWhere('date', $formattedDate);
            $totals[] = $revenueOnDay ? $revenueOnDay->total : 0;
            $currentDate->addDay();
        }

        return [
            'categories' => $dates,
            'series' => $totals,
        ];
    }
    private function getBookingStatusDistribution()
    {
        return Cache::remember('dashboard_booking_status', 600, function () {
            // Bước 1: Định nghĩa "bảng màu" và nhãn cố định
            $statusMap = [
                'pending'   => ['label' => 'Đang chờ',    'color' => '#ffc107'],
                'confirmed' => ['label' => 'Đã xác nhận', 'color' => '#0dcaf0'],
                'completed' => ['label' => 'Hoàn thành',  'color' => '#22c55e'],
                'cancelled' => ['label' => 'Đã hủy',      'color' => '#dc3545'],
            ];

            // Bước 2: Lấy dữ liệu thực tế từ database
            $statusesFromDB = Booking::query()
                ->select('bookingStatus', DB::raw('count(*) as count'))
                ->whereNotNull('bookingStatus') // Bỏ qua các booking không có trạng thái
                ->groupBy('bookingStatus')
                ->pluck('count', 'bookingStatus');

            // Bước 3: Chuẩn bị các mảng cuối cùng để gửi cho biểu đồ
            $finalLabels = [];
            $finalSeries = [];
            $finalColors = [];

            // Bước 4: Lặp qua "bảng màu" cố định để đảm bảo đúng thứ tự
            foreach ($statusMap as $statusKey => $details) {
                // Chỉ lấy những trạng thái có tồn tại trong kết quả DB
                if ($statusesFromDB->has($statusKey)) {
                    $finalLabels[] = $details['label'];
                    $finalSeries[] = $statusesFromDB[$statusKey];
                    $finalColors[] = $details['color'];
                }
            }

            // Trả về cả 3 mảng đã được sắp xếp đồng bộ

            return [
                'labels' => $finalLabels,
                'series' => $finalSeries,
                'colors' => $finalColors,
            ];
        });
    }

    // Biến phương thức public thành private helper
    private function getTopGuides()
    {
        return Cache::remember('dashboard_top_guides', 600, function () {
            return Guide::withCount('tours')->orderBy('tours_count', 'desc')->take(5)->get();
        });
    }

    private function getReviewStats()
    {
        // Lấy tất cả đánh giá, eager load quan hệ để tối ưu
        $allReviews = Review::with(['user', 'tour'])->get();

        // Đếm tổng số và tính trung bình
        $totalReviews = $allReviews->count();
        $averageRating = $totalReviews > 0 ? $allReviews->avg('average') : 0;

        // Đếm số lượng cho mỗi mức rating (1 đến 5 sao)
        $distribution = $allReviews->groupBy('average')->map->count();

        // Lấy 3 đánh giá gần đây nhất
        $latestReviews = $allReviews->sortByDesc('created_at')->take(3);

        // Trả về một mảng chứa tất cả dữ liệu
        return [
            'total' => $totalReviews,
            'average' => round($averageRating, 1),
            'distribution' => $distribution,
            'latest' => $latestReviews
        ];
    }

    // Render component view với tất cả dữ liệu
    public function render()
    {
        // Lấy danh sách tour được đặt nhiều nhất
        $topTours = Tour::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        // Lấy các booking gần đây
        $recentBookings = Booking::with('tour')
            ->latest()
            ->take(5)
            ->get();

        // dd($this->getBookingStatusDistribution());
        return view('livewire.admin.dashboard', [
            'stats' => $this->getStats(),
            'topTours' => $topTours,
            'bookingStatusDistribution' => $this->getBookingStatusDistribution(),
            'topGuides' => $this->getTopGuides(),
            'recentBookings' => $recentBookings,
            'reviewStats' => $this->getReviewStats(),
        ]);
    }
}
