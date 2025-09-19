@include('clients.blocks.header')


<!--Form Back Drop-->


<!-- Page Banner Start -->

<!-- Page Banner Start -->
<section class="page-banner-tour pt-50 pb-35 rel z-1 bgs-cover"
    style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
    <div class="container">
        <div class="banner-inner text-white">
            <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                Danh sách Tour</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                    data-aos-duration="1500" data-aos-offset="50">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách tour</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->
<!-- Page Banner End -->


<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-1 pt-10">
    <div class="container  container-1400">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-10 rmb-75">
                <div class="shop-sidebar">
                    <form action="{{ route('tour.filter') }}" method="GET">
                        <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50"
                            data-aos-duration="1500" data-aos-offset="50">
                            <h6 class="widget-title">Lọc theo giá</h6>
                            <div class="price-filter-wrap">
                                <div class="price-slider-range"></div>
                                <div class="price">
                                    <span>Giá </span>
                                    <input type="text" id="price" readonly>
                                </div>
                            </div>
                            <input type="hidden" name="min_price" id="min_price">
                            <input type="hidden" name="max_price" id="max_price">
                        </div>

                        <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Điểm đến</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_bac"
                                        value="b">
                                    <label for="id_mien_bac">Miền Bắc</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_trung"
                                        value="t">
                                    <label for="id_mien_trung">Miền Trung</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_nam"
                                        value="n">
                                    <label for="id_mien_nam">Miền Nam</label>
                                </li>

                            </ul>
                        </div>

                        <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Theo đánh giá</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="5star"
                                        value="5">
                                    <label for="5star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            (từ 5 sao)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="4star"
                                        value="4">
                                    <label for="4star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            (từ 4 sao)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="3star"
                                        value="3">
                                    <label for="3star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            (từ 3 sao)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="2star"
                                        value="2">
                                    <label for="2star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            (từ 2 sao)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="1star"
                                        value="1">
                                    <label for="1star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            (từ 1 sao)
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-duration" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Khoảng thời gian</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="time" id="duration1"
                                        value="3 Ngày 2 Đêm">
                                    <label for="duration1">3 Ngày 2 Đêm</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="time" id="duration2"
                                        value="4 Ngày 3 Đêm">
                                    <label for="duration2">4 Ngày 3 Đêm</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="time" id="duration3"
                                        value="5 Ngày 4 Đêm">
                                    <label for="duration3">5 Ngày 4 Đêm</label>
                                </li>

                            </ul>
                        </div>
                        <div class="align-xcenter pb-20">
                            <button type="submit" class="theme-btn bgc-secondary style-two">
                                <span data-hover="Lọc">Lọc</span>
                            </button>
                        </div>

                    </form>
                    <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Tour phổ biến</h6>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <span class="badge">10% Off</span>
                                <img src="{{ asset('clients/images/widgets/tour1.jpg') }}" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <img src="{{ asset('clients/images/widgets/tour1.jpg') }}" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget widget-cta mt-30" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="content text-white">
                        <span class="h6">Khám phá thế giới</span>
                        <h3>Địa điểm du lịch tốt nhất</h3>
                        <a href="tour-list.html" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Explore Now">Khám phá ngay</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('clients/images/widgets/cta-widget.png') }}" alt="CTA">
                    </div>
                    <div class="cta-shape"><img src="{{ asset('clients/images/widgets/cta-shape2.png') }}"
                            alt="Shape"></div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 ">
               

                <div class="tour-grid-wrap">
                    <div class="row">
                        @foreach ($tours as $tour)
                            <div class="col-xl-4 col-md-6">
                                <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                    data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        <span class="badge bgc-pink">Featured</span>
                                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                        <img class="img-tours"
                                            src="{{ asset('clients/images/gallery-tours/' . $tour->thumbnail->imageURL . '') }}"
                                            alt="Tour List">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                {{ $tour->destination }}</span>
                                            <div class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <h6 class="text-tour"><a
                                                href="{{ route('tour-detail', $tour->tourId) }}">{{ $tour->title }}</a>
                                        </h6>
                                        <ul class="blog-meta">
                                            <li><i class="far fa-clock"></i> {{ $tour->time }}</li>
                                            <li><i class="far fa-user"></i> {{ $tour->quantity }} Người</li>
                                        </ul>
                                        <div class="destination-footer">
                                            <span class="price"><span>{{ number_format($tour->priceAdult) }}</span>
                                                VND / Người</span>
                                            <a href="{{ route('tour-detail', $tour->tourId) }}"
                                                class="theme-btn style-two style-three">
                                                <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="col-lg-12">
                            {{ $tours->appends(request()->query())->links('vendor.pagination.custom') }}
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Tour Grid Area end -->


<!-- Newsletter Area start -->
<section class="newsletter-three bgc-primary py-100 rel z-1"
    style="background-image: url({{ asset('clients/images/newsletter/newsletter-bg-lines.png') }});">
    <div class="container container-1500">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right"
                    data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-45">
                        <h2>Đăng ký nhận bản tin của chúng tôi để nhận thêm ưu đãi và mẹo</h2>
                        <p>Một trang web <span class="count-text plus" data-speed="3000" data-stop="34500">0</span>
                            trải nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                    </div>
                    <form class="newsletter-form mb-15" action="#">
                        <input id="news-email" type="email" placeholder="Email Address" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Đặt mua">Đặt mua</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                    <p>Không yêu cầu thẻ tín dụng. Không cam kết</p>
                </div>
                <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="{{ asset('clients/images/newsletter/newsletter-bg-image.png') }}" alt="Newsletter">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter-image-part bgs-cover"
                    style="background-image: url({{ asset('clients/images/newsletter/newsletter-two-right.jpg') }});"
                    data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter Area end -->

<!-- Newsletter Area end -->

@include('clients.blocks.footer')
