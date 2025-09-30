@extends('layouts.client')
@section('title', 'History Booking')
@section('content')

<section class="page-banner-tour pt-50 pb-35 rel z-1 bgs-cover"
    style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
    <div class="container">
        <div class="banner-inner text-white">
            <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                Lịch sử Giao dịch đặt Tour</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                    data-aos-duration="1500" data-aos-offset="50">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách đặt tour</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<div class="container  container-1400 py-4">

    <!-- Filter Section -->
    <div class="filter-section mb-10">
        <form action="" method="get" class="row g-3 d-flex justify-content-between align-items-center">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Từ ngày</label>
                <input type="date" name="startDate" class="form-control" value="{{ request('startDate') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Đến ngày</label>
                <input type="date" name="endDate" class="form-control" value="{{ request('endDate') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">---Chọn trạng thái---</option>
                    @foreach ($bookingStatus as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tìm kiếm</label>
                <div class="input-group">
                    <input type="text" name="title" class="form-control"value="{{ request('title') }}" placeholder="Tour..." id="searchInput">
                </div>
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Lọc
                </button>
                <a href="{{ route('history.booking') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-undo"></i> Đặt lại
                </a>
            </div>
        </form>

    </div>



    <!-- Transaction List -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách giao dịch</h5>

        </div>
        <div class="card-body p-0">
            <!-- Transaction Item 1 -->
            @foreach ($historys as $history)
                <div class="transaction-card p-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=200&h=150"
                                alt="Tour Đà Lạt" class="tour-image">
                        </div>
                        <div class="col-md-3">
                            <h6 class="mb-1"><a
                                    href="{{ route('tour-detail', $history->tourId) }}">{{ $history->tour->title }}</a>
                            </h6>
                            <p class="mb-1 text-muted small">Mã: TDL001</p>
                            <p class="mb-0 date-text">{{ $history->tour->startDate }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="mb-1"><strong>Khách hàng:</strong></p>
                            <p class="mb-0">{{ $history->fullname }}</p>
                            <p class="mb-0 small text-muted">{{ $history->phone }}</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="mb-1 amount-text text-success">{{ number_format($history->totalPrice) }} VND</p>
                            <p class="mb-0 small text-muted">Người lớn:{{ $history->numAdults }} </p>
                            <p class="mb-0 small text-muted">Trẻ em:{{ $history->numChildren }}</p>

                        </div>
                        <div class="col-md-1 text-center">
                            <span
                                class="badge 
                                @if ($history->bookingStatus == 'pending') bg-warning
                                @elseif ($history->bookingStatus == 'confirmed')
                                    bg-info
                                @elseif ($history->bookingStatus == 'completed')
                                    bg-success
                                @else
                                    bg-danger @endif status-badge">
                                {{ ucfirst($history->bookingStatus) }}
                            </span>
                            <p class="mb-0 date-text mt-1">
                                {{ $history->checkout?->paymentDate ?? 'Chưa thanh toán' }}
                            </p>
                        </div>
                        <!-- Nút mở modal -->
                        <div class="col-md-2 text-end">
                            @if ($history->bookingStatus == 'pending')
                                <button class="btn btn-danger"
                                    onclick="openModal('confirmCancelModal{{ $history->bookingId }}')">
                                    Hủy tour
                                </button>
                            @endif
                        </div>

                        <!-- Modal xác nhận -->
                        <div id="confirmCancelModal{{ $history->bookingId }}" class="custom-modal">
                            <div class="custom-modal-content">
                                <div class="custom-modal-header">
                                    <h5>Xác nhận hủy tour</h5>
                                    <span class="close-btn"
                                        onclick="closeModal('confirmCancelModal{{ $history->bookingId }}')">&times;</span>
                                </div>
                                <div class="custom-modal-body">
                                    Bạn có chắc chắn muốn hủy tour này không?
                                </div>
                                <div class="custom-modal-footer">
                                    <button class="btn btn-secondary"
                                        onclick="closeModal('confirmCancelModal{{ $history->bookingId }}')">Đóng</button>
                                    <a href="{{ route('cancel.booking', $history->bookingId) }}"
                                        class="btn btn-danger">Xác nhận</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

@endsection


