@extends('layouts.client')
@section('title', 'Destination')
@section('content')

<!-- Page Banner Start -->
@include('clients.blocks.banner_home')
<!-- Page Banner End -->


<!-- Popular Destinations Area start -->
<section class="popular-destinations-area pt-100 pb-90 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-40" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá các điểm đến phổ biến</h2>
                    <p>Một trang web<span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất</p>
                    <ul class="destinations-nav mt-30">
                        <li data-filter="*" class="active">Hiển thị tất cả</li>
                        <li data-filter=".features">Đặc trưng</li>
                        <li data-filter=".recent">Gần đây</li>
                        <li data-filter=".city">Thành phố</li>
                        <li data-filter=".rating">Đánh giá</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row gap-10 destinations-active justify-content-center">
                <div class="col-xl-3 col-md-6 item recent rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination1.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Thailand beach</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item features">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination2.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Parga, Greece</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 item recent city rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination3.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Castellammare del Golfo, Italy</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 item city features">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination4.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Reserve of Canada, Canada</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item recent">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination5.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Dubai united states</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 item features rating">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="{{ asset('clients/images/destinations/destination6.jpg')}}" alt="Destination">
                        </div>
                        <div class="content">
                            <h6><a href="destination-details.html">Milos, Greece</a></h6>
                            <span class="time">5352+ tours & 856+ Activity</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popular Destinations Area end -->


<!-- Hot Deals Area start -->
<section class="hot-deals-area pt-70 pb-50 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá các ưu đãi hấp dẫn</h2>
                    <p>Một trang web <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">10% Off</span>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/images/destinations/hot-deal1.jpg')}}" alt="Hot Deal">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> City of Venice, Italy</span>
                        <h5><a href="tour-details.html">Venice Grand Canal, Metropolitan Summer in Venice</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/person</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Explore">Explore</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">10% Off</span>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/images/destinations/hot-deal2.jpg')}}" alt="Hot Deal">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Kyoto, Japan</span>
                        <h5><a href="tour-details.html">Japan, Kyoto, travel, and people in Kyoto, Japan by Sorasak</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/person</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Explore">Explore</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">10% Off</span>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/images/destinations/hot-deal3.jpg')}}" alt="Hot Deal">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Tamnougalt, Morocco</span>
                        <h5><a href="tour-details.html">Camels on desert under blue sky Morocco, Sahara.</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/person</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="destination-details.html" class="theme-btn style-three">
                        <span data-hover="Explore">Explore</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hot Deals Area end -->


<!-- Newsletter Area start -->
<section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url({{ asset('clients/images/newsletter/newsletter-bg-lines.png')}});">
    <div class="container container-1500">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-45">
                        <h2>Đăng ký nhận bản tin của chúng tôi để nhận thêm ưu đãi và mẹo</h2>
                        <p>Một trang web <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                    </div>
                    <form class="newsletter-form mb-15" action="#">
                        <input id="news-email" type="email" placeholder="Email Address" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Đăng ký">Đăng ký</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                    <p>Không yêu cầu thẻ tín dụng. Không cam kết</p>
                </div>
                <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                    <img src="{{ asset('clients/images/newsletter/newsletter-bg-image.png')}}" alt="Newsletter">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter-image-part bgs-cover" style="background-image: url({{ asset('clients/images/newsletter/newsletter-two-right.jpg')}});" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter Area end -->
@endsection
