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
                        <ol class="breadcrumb mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500"
                            data-aos-offset="50">
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
    <section class="tour-header-area pt-40 rel z-1">
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
            <hr class="mt-20 mb-32">
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
                        {!! $tour->locationMap
                            ? $tour->locationMap->map_link
                            : '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15743934.179627616!2d95.17553889747548!3d15.55238780190194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31157a4d736a1e5f%3A0xb03bb0c9e2fe62be!2zVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1759505957134!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}

                    </div>

                    <h3>Đánh giá của khách hàng</h3>
                    @if ($reviewStats)
                        <div class="clients-reviews bgc-black mt-30 mb-60">
                            <div class="left">
                                <b>{{ $reviewStats['overall_avg'] }}</b>
                                <span>({{ $reviewStats['total'] }} Lượt xem)</span>
                                <div class="ratting">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star{{ $i <= $reviewStats['overall_avg'] ? '' : '-outline' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="right">
                                @php $criteriaStats = ['service' => 'Dịch vụ', 'food' => 'Đồ ăn', 'price' => 'Giá', 'hotel' => 'Khách sạn']; @endphp
                                @foreach ($criteriaStats as $key => $label)
                                    <div class="ratting-item">
                                        <span class="title">{{ $label }}</span>
                                        <span class="line"><span
                                                style="width: {{ $reviewStats[$key . '_avg'] * 20 }}%;"></span></span>
                                        <div class="ratting">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star{{ $i <= $reviewStats[$key . '_avg'] ? '' : '-outline' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="clients-reviews bgc-black mt-30 mb-60">
                            <div class="left">
                                <b>#</b>
                                <span>Chưa có đánh giá</span>

                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="right">
                                <div class="ratting-item">
                                    <span class="title">Dịch vụ</span>
                                    <span class="line"><span style="width: 100%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>

                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Đồ ăn</span>
                                    <span class="line"><span style="width: 100%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Giá</span>
                                    <span class="line"><span style="width: 100%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Khách sạn</span>
                                    <span class="line"><span style="width: 100%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                    <h3>Ý kiến ​​khách hàng</h3>
                    <div class="comments mt-30 mb-60">
                        @forelse ($reviews as $review)
                            <div class="comment-body">
                                <div class="author-thumb">
                                    <img src="{{ $review->user->avatar ? asset('clients/images/avatar/' . $review->user->avatar) : asset('clients/images/avatar/avatar-default.png') }}"
                                        alt="Author">
                                </div>
                                <div class="content">
                                    <h6>{{ $review->user->fullname }}</h6>
                                    <div class="ratting">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->average ? '' : '-outline' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="time">{{ $review->created_at->format('d/m/Y') }}</span>
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="comment-body">

                                <p>Hãy là người đầu tiên để lại đánh giá cho tour này!</p>

                            </div>
                        @endforelse

                        {{-- Hiển thị phân trang --}}
                        <div class="mt-4">
                            {{ $reviews->links() }}
                        </div>
                    </div>

                    <h3>Thêm đánh giá</h3>

                    <form action="{{ route('reviews.store', $tour) }}" method="post" class="card p-20 rounded-b-sm">
                        @csrf
                        <div class="comment-review-wrap">
                            @php $criteria = ['service' => 'Dịch vụ', 'food' => 'Đồ ăn', 'price' => 'Giá', 'hotel' => 'Khách sạn']; @endphp
                            @foreach ($criteria as $key => $label)
                                <div class="comment-ratting-item">
                                    <span class="title">{{ $label }}</span>
                                    <div class="star-rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="{{ $key }}-{{ $i }}"
                                                name="{{ $key }}" value="{{ $i }}" required>
                                            <label for="{{ $key }}-{{ $i }}">&#9733;</label>
                                        @endfor
                                    </div>
                                    @error($key)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <hr class="mt-30 mb-40">
                        <div class="form-group">
                            <label for="comment">Bình luận của bạn</label>
                            <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                            @error('comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="theme-btn">Gửi đánh giá <i
                                    class="far fa-arrow-right"></i></button>
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
