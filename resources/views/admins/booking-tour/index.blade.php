@extends('layouts.admin')
@section('title', 'Quản lý Đơn đặt tour')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-gray-800">Quản lý Đơn đặt tour</h4>
            <a href="{{ route('admin.trashBooking') }}" class="btn btn-outline-secondary">
                <i class="fas fa-trash-alt me-2"></i>Thùng rác
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-primary shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Tổng số đơn</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-warning shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Đang chờ</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['pending'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-info shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Đã xác nhận</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['confirmed'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-success shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Đã hoàn thành</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['completed'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-light py-3">
                <form method="GET" action="{{ route('admin.listBooking') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm theo mã đơn, tên khách, tên tour..." value="{{ request('search') }}">
                        <select name="status" class="form-select" style="max-width: 200px;">
                            <option value="">Tất cả trạng thái</option>
                            <option value="Pending" @selected(request('status') == 'Pending')>Đang chờ</option>
                            <option value="Confirmed" @selected(request('status') == 'Confirmed')>Đã xác nhận</option>
                            <option value="Completed" @selected(request('status') == 'Completed')>Đã hoàn thành</option>
                            <option value="Cancelled" @selected(request('status') == 'Cancelled')>Đã hủy</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th>Khách hàng</th>
                                <th>Tour đã đặt</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>
                                        <div class="customer-info">
                                            <img src="{{ asset('clients/images/avatar/' . $booking->user->avatar ?? 'clients/images/avatar/avatar-default.png') }}"
                                                class="customer-avatar" alt="Avatar">
                                            <div>
                                                <p class="customer-name">{{ $booking->fullname }}</p>
                                                <span class="customer-email">{{ $booking->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('clients/images/gallery-tours/' . $booking->tour->thumbnail->imageURL ?? 'clients/images/gallery-tours//default-image.jpg') }}"
                                                alt="{{ $booking->tour->title ?? 'Tour Image' }}" class="me-3"
                                                style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

                                            <div>
                                                <p class="mb-0 fw-bold">
                                                    {{ Str::limit($booking->tour->title ?? 'N/A', 40) }}</p>
                                                <small class="text-muted">Mã: #{{ $booking->bookingId }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y') }}</td>
                                    <td>
                                        <strong class="text-danger">{{ number_format($booking->totalPrice, 0, ',', '.') }}
                                            đ</strong>
                                    </td>
                                    <td class="text-center">
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
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.showBooking', $booking) }}"
                                            class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Không có đơn đặt tour nào.</h5>
                                            <p>Thử thay đổi bộ lọc hoặc tìm kiếm của bạn.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($bookings->hasPages())
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
