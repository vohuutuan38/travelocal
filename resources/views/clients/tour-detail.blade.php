@extends('layouts.client')
@section('title', 'tour-detail')
@section('content')


    <!-- Page Banner Start -->
    <section class="page-banner-two rel z-1 pt-100">
        <div class="container-fluid">
            <hr class="mt-0">
            <div class="container">
                <div class="banner-inner flex-center-tourdetail pt-15 pb-25">
                    <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                        {{ $tour->title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                            data-aos-duration="1500" data-aos-offset="50">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active breadcrumb-tour-detail">{{ $tour->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Tour Gallery start -->
    @php
        $imageUrls = $tour->images->pluck('imageURL'); // lấy danh sách imageURL
    @endphp

    <div class="tour-gallery">
        <div class="container-fluid">
            <div class="row gap-10 justify-content-center rel">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item anh-trai">
                        <img src="{{ asset('clients/images/gallery-tours/' . ($imageUrls[0] ?? 'default.jpg')) }}"
                            alt="Destination">
                    </div>
                    <div class="gallery-item anh-trai">
                        <img src="{{ asset('clients/images/gallery-tours/' . ($imageUrls[1] ?? 'default.jpg')) }}"
                            alt="Destination">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item anh-giua">
                        <img src="{{ asset('clients/images/gallery-tours/' . ($imageUrls[2] ?? 'default.jpg')) }}"
                            alt="Destination">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item anh-phai">
                        <img src="{{ asset('clients/images/gallery-tours/' . ($imageUrls[3] ?? 'default.jpg')) }}"
                            alt="Destination">
                    </div>
                    <div class="gallery-item anh-phai">
                        <img src="{{ asset('clients/images/gallery-tours/' . ($imageUrls[4] ?? 'default.jpg')) }}"
                            alt="Destination">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tour Gallery End -->


    <!-- Tour Header Area start -->
    <section class="tour-header-area pt-70 rel z-1">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-12 col-lg-12">
                    <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <span class="location d-inline-block mb-10"><i class="fal fa-map-marker-alt"></i>
                            {{ $tour->city->name }}</span>
                        <div class="section-title pb-5">
                            <h2>{{ $tour->title }}</h2>
                        </div>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

            </div>
            <hr class="mt-50 mb-70">
        </div>
    </section>
    <!-- Tour Header Area end -->


    <!-- Tour Details Area start -->
    <section class="tour-details-page pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour-details-content">
                        <h3>Khám phá các chuyến tham quan</h3>
                        <p>{{ $tour->description }}</p>
                        <div class="row pb-55">
                            <!-- Bao gồm -->
                            <div class="col-md-6">
                                <div class="tour-include-exclude mt-30">
                                    <h5>Bao gồm</h5>
                                    <ul class="list-style-one check mt-25">
                                        @foreach ($tour->includes as $include)
                                            <li><i class="far fa-check"></i> {{ $include->content }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            <!-- Đã loại trừ -->
                            <div class="col-md-6">
                                <div class="tour-include-exclude mt-30">
                                    <h5>Đã loại trừ</h5>
                                    <ul class="list-style-one mt-25">
                                        @foreach ($tour->excludes as $exclude)
                                            <li><i class="far fa-times"></i> {{ $exclude->content }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h3>Các hoạt động</h3>
                    <div class="tour-activities mt-30 mb-45">
                        @foreach ($tour->activities as $activity)
                            
                        <div class="tour-activity-item">
                            {!! $activity->icon !!}
                            <b>{{ $activity->name }}</b>
                        </div>
                        @endforeach
                       
                    </div>

                    <h3>Hành trình</h3>
                    <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                        @foreach ($tour->timelines as $key => $timeline)
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwoOne-{{ $key }}">
                                        Ngày {{ $key + 1 }} - {{ $timeline->title }}
                                    </button>
                                </h5>
                                <div id="collapseTwoOne-{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>{{ $timeline->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <h3>Câu hỏi thường gặp</h3>
                    <div class="accordion-one mt-25 mb-60" id="faq-accordion">
                        @foreach ($faqs as $key => $item)
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $key }}">
                                        {{ $key + 1 }}. {{ $item->question }}
                                    </button>
                                </h5>
                                <div id="collapse-{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>{{ $item->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <h3>Bản đồ</h3>
                    <div class="tour-map mt-30 mb-50">
                      {!! $tour->locationMap ? $tour->locationMap->map_link : '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15743934.179627616!2d95.17553889747548!3d15.55238780190194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31157a4d736a1e5f%3A0xb03bb0c9e2fe62be!2zVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1759505957134!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                           
                    </div>

                    <h3>Đánh giá của khách hàng</h3>
                    <div class="clients-reviews bgc-black mt-30 mb-60">
                        <div class="left">
                            <b>4.8</b>
                            <span>(586 Lượt xem)</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="right">
                            <div class="ratting-item">
                                <span class="title">Dịch vụ</span>
                                <span class="line"><span style="width: 80%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="ratting-item">
                                <span class="title">Hướng dẫn</span>
                                <span class="line"><span style="width: 70%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="ratting-item">
                                <span class="title">Giá</span>
                                <span class="line"><span style="width: 80%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="ratting-item">
                                <span class="title">Sự an toàn</span>
                                <span class="line"><span style="width: 80%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="ratting-item">
                                <span class="title">Đồ ăn</span>
                                <span class="line"><span style="width: 80%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="ratting-item">
                                <span class="title">Khách sạn</span>
                                <span class="line"><span style="width: 80%;"></span></span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Ý kiến ​​khách hàng</h3>
                    <div class="comments mt-30 mb-60">
                        <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="author-thumb">
                                <img src="{{ asset('clients/images/blog/comment-author1.jpg') }}" alt="Author">
                            </div>
                            <div class="content">
                                <h6>Lonnie B. Horwitz</h6>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                    cultural exchanges, and the joy of exploration.</p>
                                <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class="comment-body comment-child" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <div class="author-thumb">
                                <img src="{{ asset('clients/images/blog/comment-author2.jpg') }}" alt="Author">
                            </div>
                            <div class="content">
                                <h6>William G. Edwards</h6>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                    cultural exchanges, and the joy of exploration.</p>
                                <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="author-thumb">
                                <img src="{{ asset('clients/images/blog/comment-author3.jpg') }}" alt="Author">
                            </div>
                            <div class="content">
                                <h6>Jaime B. Wilson</h6>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                    cultural exchanges, and the joy of exploration.</p>
                                <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <h3>Thêm đánh giá</h3>
                    <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30" name="review-form"
                        action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="comment-review-wrap">
                            <div class="comment-ratting-item">
                                <span class="title">Dịch vụ</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="comment-ratting-item">
                                <span class="title">Hướng dẫn</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="comment-ratting-item">
                                <span class="title">Giá</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="comment-ratting-item">
                                <span class="title">Sự an toàn</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="comment-ratting-item">
                                <span class="title">Đồ ăn</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="comment-ratting-item">
                                <span class="title">Khách sạn</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-30 mb-40">
                        <h5>Để lại phản hồi</h5>
                        <div class="row gap-20 mt-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full-name">Họ và tên</label>
                                    <input type="text" id="full-name" name="full-name" class="form-control"
                                        value="" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        value="" required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email-address">Email</label>
                                    <input type="email" id="email-address" name="email" class="form-control"
                                        value="" required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Bình luận</label>
                                    <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <button type="submit" class="theme-btn bgc-secondary style-two">
                                        <span data-hover="Gửi đánh giá">Gửi đánh giá</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                    <div class="blog-sidebar tour-sidebar">

                        <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h5 class="widget-title">Đặt tour</h5>
                            <form action="{{ route('booking', $tour->tourId) }}" method="GET">
                                @csrf
                                <div class="date mb-25">
                                    <b>Ngày bắt đầu</b>
                                    <input type="text" value="{{ date('d-m-Y', strtotime($tour->startDate)) }}"
                                        name="starDate" disabled>
                                </div>
                                <div class="date mb-25">
                                    <b>Ngày kết thúc</b>
                                    <input type="text" value="{{ date('d-m-Y', strtotime($tour->endDate)) }}"
                                        name="endDate" disabled>
                                </div>
                                <hr>
                                <div class="time py-5">
                                    <b>Thời gian :</b>
                                    {{-- <ul class="radio-filter">
                                    <li>
                                        <input class="form-check-input" checked type="radio" name="time"
                                            id="time1">
                                        <label for="time1">12:00</label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="time"
                                            id="time2">
                                        <label for="time2">08:00</label>
                                    </li>
                                </ul> --}}
                                    <p>{{ $tour->time }}</p>
                                    <input type="hidden" name="time" value="{{ $tour->time }}">
                                </div>
                                <hr class="mb-25">
                                <h6>Vé:</h6>
                                <ul class="tickets clearfix">
                                    <li>
                                        Người lớn (trên 18 tuổi) <span
                                            class="price">{{ number_format($tour->priceAdult, 0, ',', '.') }} VND</span>
                                    </li>
                                    <li>
                                        Trẻ em <span class="price">{{ number_format($tour->priceChild, 0, ',', '.') }}
                                            VND</span>
                                    </li>
                                </ul>
                                <hr>
                                @if (Auth::check())
                                    @if ($hasPendingBooking)
                                        <a href="" class="theme-btn bgc-secondary style-two w-100 mt-15 mb-5">
                                            <span data-hover="Hủy tour">Hủy tour</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </a>
                                    @else
                                        <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                            <span data-hover="Đặt ngay">Đặt ngay</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                    @endif
                                @else
                                    {{-- Trường hợp chưa đăng nhập, cũng hiển thị "Đặt ngay" --}}
                                    <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                        <span data-hover="Đặt ngay">Đặt ngay</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                @endif



                                <div class="text-center">
                                    <a href="{{ route('contact') }}">Cần trợ giúp?</a>
                                </div>
                            </form>
                        </div>

                        <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h5 class="widget-title">Cần trợ giúp?</h5>
                            <ul class="list-style-one">
                                <li><i class="far fa-envelope"></i> <a
                                        href="emilto:vohuutuan04@gmail.com">vohuutuan04@gmail.com</a></li>
                                <li><i class="far fa-phone-volume"></i> <a href="callto: 0799123089">+84 0799123089</a>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="content text-white">
                                <span class="h6">Khám phá thế giới</span>
                                <h3>Địa điểm du lịch tốt nhất</h3>
                                <a href="tour-grid.html" class="theme-btn style-two bgc-secondary">
                                    <span data-hover="Khám phá ngay">Khám phá ngay</span>
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="image">
                                <img src="{{ asset('clients/images/widgets/cta-widget.png') }}" alt="CTA">
                            </div>
                            <div class="cta-shape"><img src="{{ asset('clients/images/widgets/cta-shape3.png') }}"
                                    alt="Shape"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tour Details Area end -->

@endsection
