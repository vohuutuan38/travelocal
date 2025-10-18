@extends('layouts.client')
@section('title', 'contact')
@section('content')

    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
        <div class="container">
            <div class="banner-inner text-white">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Liên hệ với
                    chúng tôi</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Liên hệ với chúng tôi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Contact Info Area start -->
    <section class="contact-info-area pt-100 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact-info-content mb-30 rmb-55" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="section-title mb-30">
                            <h2>Hãy cùng trò chuyện với các hướng dẫn viên du lịch chuyên nghiệp của chúng tôi</h2>
                        </div>
                        <p>Đội ngũ hỗ trợ tận tâm của chúng tôi luôn sẵn sàng hỗ trợ bạn giải quyết mọi thắc mắc hoặc vấn
                            đề, cung cấp các giải pháp nhanh chóng và được cá nhân hóa để đáp ứng nhu cầu của bạn.</p>
                        <div class="features-team-box mt-40">
                            <h6>85+ Thành viên nhóm chuyên gia</h6>
                            <div class="feature-authors">
                                @foreach ($guides as $guide)
                                    <img src="{{ asset('clients/images/guide/' . $guide->avatar) }}" alt="Author">
                                @endforeach

                                <span>+</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="50">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="content">
                                    <h5>Cần trợ giúp và hỗ trợ</h5>
                                    <div class="text"><i class="far fa-envelope"></i> <a
                                            href="mailto:vohuutuan04@gmail.com">vohuutuan04@gmail.com</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="100">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div class="content">
                                    <h5>Cần gấp</h5>
                                    <div class="text"><i class="far fa-phone"></i> <a href="callto:+84 799123089">+84
                                            799123089</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="50">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="content">
                                    <h5>Chi nhánh</h5>
                                    <div class="text"><i class="fal fa-map-marker-alt"></i> 8/11/36/7 Phú Đô , Lê Quang
                                        Đạo , Hà Nội</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="100">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="content">
                                    <h5>Địa chỉ văn phòng</h5>
                                    <div class="text"><i class="fal fa-map-marker-alt"></i> 8/11/36/7 Phú Đô , Lê Quang
                                        Đạo , Hà Nội</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info Area end -->


    <!-- Contact Form Area start -->
    <section class="contact-form-area py-70 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="comment-form bgc-lighter z-1 rel mb-30 rmb-55">
                        <form id="contactForm" class="contactForm" name="contactForm" action="{{ route('contact.send') }}"
                            method="post" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            @csrf 
                            <div class="section-title">
                                <h2>Liên hệ</h2>
                            </div>
                            <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu*</p>
                            <div class="row mt-35">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên đầy đủ</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Số điện thoại</label>
                                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                                            value="{{ old('phone_number') }}" required>
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Địa chỉ email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Tin nhắn của bạn</label>
                                        <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn style-two">
                                            <span data-hover="Gửi">Gửi</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-images-part" data-aos="fade-right" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('clients/images/contact/contact1.jpg') }}" alt="Contact">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('clients/images/contact/contact2.jpg') }}" alt="Contact">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('clients/images/contact/contact3.jpg') }}" alt="Contact">
                            </div>
                        </div>
                        <div class="circle-logo">
                            <img src="{{ asset('clients/images/contact/icon.png') }}" alt="Logo">
                            <span class="title h2">Travelocal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form Area end -->


    <!-- Contact Map Start -->
    <div class="contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8769961.263079252!2d96.86968948295488!3d15.635673857928198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31157a4d736a1e5f%3A0xb03bb0c9e2fe62be!2zVmnhu4d0IE5hbQ!5e1!3m2!1svi!2s!4v1760712458722!5m2!1svi!2s"
            style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Contact Map End -->
@endsection
