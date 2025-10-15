<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng doanh thu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($stats['totalRevenue']) }} đ</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng đơn đặt</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['totalBookings'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Người dùng mới (Tháng)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['newUsersThisMonth'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tổng số Tour</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['totalTours'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-map-marked-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tổng quan doanh thu</h6>
                    <div class="btn-group btn-group-sm">
                        <button wire:click.prevent="$set('period', 'last_7_days')"
                            class="btn btn-outline-secondary {{ $period == 'last_7_days' ? 'active' : '' }}">7
                            ngày</button>
                        <button wire:click.prevent="$set('period', 'last_30_days')"
                            class="btn btn-outline-secondary {{ $period == 'last_30_days' ? 'active' : '' }}">30
                            ngày</button>
                        <button wire:click.prevent="$set('period', 'last_60_days')"
                            class="btn btn-outline-secondary {{ $period == 'last_60_days' ? 'active' : '' }}">60
                            ngày</button>
                    </div>
                </div>
                <div class="card-body">
                    <div wire:ignore id="revenueChart" style="height: 350px;"></div>
                    <div wire:loading class="text-center">Đang tải dữ liệu...</div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tour được đặt nhiều nhất</h6>
                </div>
                <div class="card-body min-height-tours">
                    <ul class="list-group list-group-flush">
                        @forelse($topTours as $tour)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ Str::limit($tour->title, 30) }}
                                <span class="badge bg-primary rounded-pill">{{ $tour->bookings_count }} lượt</span>
                            </li>
                        @empty
                            <li class="list-group-item">Chưa có dữ liệu.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Đơn đặt gần đây</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã Đơn</th>
                                    <th>Tên Tour</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentBookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->bookingId }}</td>
                                        <td>{{ Str::limit($booking->tour->title ?? 'N/A', 35) }}</td>
                                        <td>{{ $booking->fullname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($booking->totalPrice) }} đ</td>
                                        <td>
                                            @php
                                                $statusConfig = [
                                                    'pending' => [
                                                        'class' => 'bg-warning bg-opacity-25 text-dark',
                                                        'text' => 'Đang chờ',
                                                    ],
                                                    'confirmed' => [
                                                        'class' => 'bg-info bg-opacity-25 text-dark',
                                                        'text' => 'Đã xác nhận',
                                                    ],
                                                    'completed' => [
                                                        'class' => 'bg-success bg-opacity-25 text-white',
                                                        'text' => 'Hoàn thành',
                                                    ],
                                                    'cancelled' => [
                                                        'class' => 'bg-danger bg-opacity-25 ',
                                                        'text' => 'Đã hủy',
                                                    ],
                                                ][$booking->bookingStatus] ?? [
                                                    'class' => 'bg-secondary bg-opacity-25 text-dark',
                                                    'text' => $booking->bookingStatus,
                                                ];
                                            @endphp
                                            <span
                                                class="badge rounded-pill fw-semibold px-3 py-2 {{ $statusConfig['class'] }}">
                                                {{ $statusConfig['text'] }}
                                            </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái Booking</h6>
                </div>
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <div wire:ignore id="bookingStatusChart"></div>
                    </div>
                    <div class="mt-4 text-center small" id="bookingStatusChartLabels">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Hướng dẫn viên</h6>
                </div>
                <div class="card-body min-height-guides">
                    <ul class="list-group list-group-flush">
                        @forelse($topGuides as $guide)
                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ $guide->avatar ? asset('clients/images/guide/' . $guide->avatar) : asset('clients/images/avatar/avatar-default.png') }}"
                                    alt="{{ $guide->name }}" class="rounded-circle me-3" width="40"
                                    height="40">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $guide->name }}</h6>
                                    <small class="text-muted">{{ $guide->tours_count }} tours</small>
                                </div>
                                <span
                                    class="badge bg-light text-primary rounded-pill fs-6">{{ $loop->iteration }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center">Chưa có dữ liệu.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4">
   

    <div class="col-lg-7 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Phân bổ & Thống kê đánh giá</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 text-center d-flex flex-column justify-content-center">
                        <h4 class="font-weight-bold">{{ $reviewStats['average'] }} / 5</h4>
                        <div class="text-warning mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= round($reviewStats['average']) ? '' : ' fa-regular' }}"></i>
                            @endfor
                        </div>
                        <span class="text-muted">Dựa trên {{ $reviewStats['total'] }} đánh giá</span>
                    </div>
                    <div class="col-md-7">
                        @for ($i = 5; $i >= 1; $i--)
                            @php
                                $count = $reviewStats['distribution']->get($i, 0);
                                $percent = $reviewStats['total'] > 0 ? ($count / $reviewStats['total']) * 100 : 0;
                            @endphp
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-nowrap me-2">{{ $i }} sao</span>
                                <div class="progress" style="width: 100%;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="text-muted ms-2">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Đánh giá mới nhất</h6>
            </div>
            <div class="card-body">
                @forelse ($reviewStats['latest'] as $review)
                    <div class="d-flex {{ !$loop->last ? 'mb-4' : '' }}">
                        <img src="{{ $review->user->avatar ? asset('clients/images/avatar/' . $review->user->avatar) : asset('clients/images/avatar/avatar-default.png') }}" 
                             alt="Avatar" class="rounded-circle me-3" width="45" height="45">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">{{ $review->user->fullname ?? 'Anonymous' }}</h6>
                                <div class="text-warning small">
                                    @for ($i = 1; $i <= $review->average; $i++) <i class="fas fa-star"></i> @endfor
                                </div>
                            </div>
                            <small class="text-muted">
                                cho tour: {{ Str::limit($review->tour->title ?? 'N/A', 25) }}
                            </small>
                            <p class="mb-0 mt-1 small fst-italic">"{{ Str::limit($review->comment, 80) }}"</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-muted">Chưa có đánh giá nào.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Khởi tạo biểu đồ khi trang được tải
        const chartOptions = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Doanh thu',
                data: []
            }],
            xaxis: {
                categories: []
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return new Intl.NumberFormat('vi-VN').format(val) + " đ"
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#revenueChart"), chartOptions);
        chart.render();

        // Lắng nghe sự kiện 'updateChart' từ Livewire
        document.addEventListener('livewire:initialized', () => {
            @this.on('updateChart', (event) => {
                // Cập nhật dữ liệu và categories cho biểu đồ
                chart.updateOptions({
                    xaxis: {
                        categories: event.data.categories
                    },
                    series: [{
                        name: 'Doanh thu',
                        data: event.data.series
                    }]
                });
            });


            const statusChartOptions = {
                chart: {
                    type: 'donut',
                    height: 300,
                },
                // Truyền dữ liệu trực tiếp từ component
                series: @json($bookingStatusDistribution['series']),
                labels: @json($bookingStatusDistribution['labels']),
                // SỬA LẠI DÒNG NÀY: Dùng mảng màu được truyền từ component
                colors: @json($bookingStatusDistribution['colors']),

                // ... các tùy chọn khác giữ nguyên
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Tổng số',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                }
            };

            const statusChart = new ApexCharts(document.querySelector("#bookingStatusChart"), statusChartOptions);
            // Kiểm tra xem div có tồn tại không trước khi render
            if (document.querySelector("#bookingStatusChart")) {
                statusChart.render();
            }

            // Tạo labels chú thích cho biểu đồ tròn
            const chartLabelsContainer = document.getElementById('bookingStatusChartLabels');
            if (chartLabelsContainer) {
                chartLabelsContainer.innerHTML = ''; // Xóa label cũ để tránh trùng lặp
                statusChartOptions.labels.forEach((label, index) => {
                    const color = statusChartOptions.colors[index];
                    const labelSpan = document.createElement('span');
                    labelSpan.className = 'me-2';
                    labelSpan.innerHTML = `<i class="fas fa-circle" style="color:${color};"></i> ${label}`;
                    chartLabelsContainer.appendChild(labelSpan);
                });
            }
        });
    </script>
@endpush
