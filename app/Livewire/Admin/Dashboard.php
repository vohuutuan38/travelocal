<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Tour;
use App\Models\User;
use App\Models\Guide;
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
            'last_90_days' => $endDate->copy()->subDays(89),
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
            $statuses = Booking::query()
                ->select('bookingStatus', DB::raw('count(*) as count'))
                ->groupBy('bookingStatus')
                ->pluck('count', 'bookingStatus');

            $labels = $statuses->keys()->map(function ($status) {
                return match (strtolower(trim($status))) {
                    'pending' => 'Đang chờ',
                    'confirmed' => 'Đã xác nhận',
                    'completed' => 'Hoàn thành',
                    'cancelled' => 'Đã hủy',
                    default => $status,
                };
            });
            return ['labels' => $labels->values()->all(), 'series' => $statuses->values()->all()];
        });
    }

    // Biến phương thức public thành private helper
    private function getTopGuides()
    {
        return Cache::remember('dashboard_top_guides', 600, function () {
            return Guide::withCount('tours')->orderBy('tours_count', 'desc')->take(5)->get();
        });
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
        ]);
    }
}
