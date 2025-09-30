@extends('layouts.client')
@section('title', 'booking')
@section('content')


<div class="container py-110">
    <div style="display: none;" data-price-adult="{{ $tour->priceAdult }}" data-price-child="{{ $tour->priceChild }}">
    </div>

    <form action="{{ route('booking.store') }}" method="post" class="booking-container">
        @csrf
        <input type="hidden" name="tourId" value="{{ $tour->tourId }}">
        <input type="hidden" name="userId" value="{{ auth()->user()->userId }}">


        <div class="booking-info">
            <h2 class="booking-header">Thông Tin Liên Lạc</h2>
            <div class="booking__infor">
                <div class="form-group">
                    <label for="username">Họ và tên*</label>
                    <input type="text" id="username" placeholder="Nhập Họ và tên" name="username"
                        value="{{ $user->fullname }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" placeholder="sample@gmail.com" name="email"
                        value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="tel">Số điện thoại*</label>
                    <input type="tel" id="tel" placeholder="Nhập số điện thoại liên hệ" name="tel"
                        value="{{ $user->phoneNumber }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ*</label>
                    <input type="text" id="address" placeholder="Nhập địa chỉ liên hệ" name="dia_chi"
                        value="{{ $user->address }}" required>
                </div>
            </div>


            <h2 class="booking-header">Hành Khách</h2>
            <div class="booking__quantity">
                <div class="form-group quantity-selector">
                    <label>Người lớn</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="1" min="1" id="numAdults"
                            readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>

                <div class="form-group quantity-selector">
                    <label>Trẻ em</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="0" min="0" id="numChildren"
                            readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>
            </div>


            <h2 class="booking-header">Phương Thức Thanh Toán</h2>

            <label class="payment-option">
                <input type="radio" name="payment" value="office-payment" required>
                <img src="{{ asset('clients/images/shop/cod.png') }}" alt="Office Payment">
                Thanh toán tại văn phòng
            </label>

            <label class="payment-option">
                <input type="radio" name="payment" value="paypal-payment" disabled>
                <img src="{{ asset('clients/images/shop/paypal.png') }}" alt="PayPal">
                Thanh toán bằng PayPal (Sắp có)
            </label>

            <label class="payment-option">
                <input type="radio" name="payment" value="momo-payment" disabled>
                <img src="{{ asset('clients/images/shop/momo.png') }}" alt="MoMo">
                Thanh toán bằng Momo (Sắp có)
            </label>
        </div>


        <div class="booking-summary">
            <div class="summary-section">
                <div>
                    <h5 class="widget-title">{{ $tour->title }}</h5>
                    <p>Ngày khởi hành: {{ date('d-m-Y', strtotime($tour->startDate)) }}</p>
                    <p>Ngày kết thúc: {{ date('d-m-Y', strtotime($tour->endDate)) }}</p>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Người lớn:</span>
                        <div>
                            <span class="quantity_adults">1</span>
                            <span> x </span>
                            <span class="total-price">{{ number_format($tour->priceAdult) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="summary-item">
                        <span>Trẻ em:</span>
                        <div>
                            <span class="quantity_children">0</span>
                            <span> x </span>
                            <span class="total-price">0 VNĐ</span>
                        </div>
                    </div>

                    <div class="summary-item">
                        <span>Giảm giá:</span>
                        <span class="total-price">0 VNĐ</span>
                    </div>

                    <div class="summary-item total-price">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($tour->priceAdult) }} VNĐ</span>
                    </div>
                </div>
                <div class="privacy-section">
                    <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                        này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ của
                        Lửa Việt Tours.</p>
                    <div class="privacy-checkbox">
                        <input type="checkbox" id="agree" name="agree" required>
                        <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản
                                thanh
                                toán</a></label>
                    </div>
                </div>
                <button type="submit" class="booking-btn" disabled>Xác Nhận và Thanh Toán</button>

            </div>
        </div>
    </form>
</div>
@endsection

