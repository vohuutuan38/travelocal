@extends('layouts.admin')
@section('title', 'Chi tiết đơn #' . $booking->bookingId)

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Chi tiết đơn: #{{ $booking->bookingId }}</h5>
            <a href="{{ route('admin.listBooking') }}" class="btn btn-secondary btn-sm"><i
                    class="fas fa-arrow-left me-2"></i>Quay lại danh sách</a>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Thông tin Tour đã đặt</h6>
                        <span>Ngày đặt: {{ \Carbon\Carbon::parse($booking->bookingDate)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('clients/images/gallery-tours/'.$booking->tour->thumbnail->imageURL) }}" alt="{{ $booking->tour->title }}"
                                class="img-fluid rounded me-3" style="width: 120px; height: 90px; object-fit: cover;">
                            <div>
                                <h5 class="mb-1">{{ $booking->tour->title }}</h5>
                                <p class="text-muted mb-1">Thời gian: {{ $booking->tour->time }}</p>
                                <p class="mb-0">Khởi hành:
                                    {{ \Carbon\Carbon::parse($booking->tour->startDate)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Số người lớn:</strong> {{ $booking->numAdults }}</p>
                                <p><strong>Số trẻ em:</strong> {{ $booking->numChildren }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-danger">Tổng chi phí:
                                    {{ number_format($booking->totalPrice, 0, ',', '.') }} đ</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Thông tin khách hàng</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Họ và tên:</strong> {{ $booking->fullname }}</p>
                        <p><strong>Email:</strong> {{ $booking->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $booking->phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $booking->address }}</p>
                        @if ($booking->user)
                            <p><strong>Tài khoản:</strong> <a href="#">{{ $booking->user->userName }}</a></p>
                        @else
                            <p><strong>Tài khoản:</strong> Khách vãng lai</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Trạng thái đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.updateStatusBooking', $booking) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="bookingStatus" class="form-label">Cập nhật trạng thái</label>
                                <select class="form-select" id="bookingStatus" name="bookingStatus">
                                    <option value="Pending" @selected($booking->bookingStatus == 'Pending')>Đang chờ</option>
                                    <option value="Confirmed" @selected($booking->bookingStatus == 'Confirmed')>Đã xác nhận</option>
                                    <option value="Completed" @selected($booking->bookingStatus == 'Completed')>Đã hoàn thành</option>
                                    <option value="Cancelled" @selected($booking->bookingStatus == 'Cancelled')>Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                        </form>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Hành động:</span>
                            <form action="{{ route('admin.deleteBooking', $booking) }}" method="POST"
                                onsubmit="return confirm('Bạn có muốn chuyển đơn này vào thùng rác?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i> Xóa
                                    đơn</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Thông tin thanh toán (Checkout)</h6>
                    </div>
                    <div class="card-body">
                        @if ($booking->checkout)
                            <p><strong>Phương thức:</strong> {{ $booking->checkout->paymentMethod }}</p>
                            <p><strong>Ngày thanh toán:</strong>
                                {{ $booking->checkout->paymentDate ? \Carbon\Carbon::parse($booking->checkout->paymentDate)->format('d/m/Y H:i') : 'Chưa có' }}
                            </p>
                            <p><strong>Trạng thái:</strong>
                                @php
                                    $paymentStatusClass =
                                        $booking->checkout->paymentStatus == 'Paid'
                                            ? 'bg-success'
                                            : 'bg-warning text-dark';
                                @endphp
                                <span
                                    class="badge {{ $paymentStatusClass }}">{{ $booking->checkout->paymentStatus }}</span>
                            </p>
                            <p><strong>Mã giao dịch:</strong> {{ $booking->checkout->transactionId ?? 'N/A' }}</p>
                        @else
                            <p class="text-muted text-center">Chưa có thông tin thanh toán.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
