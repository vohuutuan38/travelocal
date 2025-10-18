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
                <div class="section-title text-center mb-40" data-aos="fade-up" data-aos-duration="1500">
                    <h2>Khám phá các điểm đến</h2>
                    
                    {{-- BỘ LỌC ĐÃ ĐƯỢC CẬP NHẬT THÀNH CÁC ĐƯỜNG LINK --}}
                    <ul class="destinations-nav mt-30">
                        {{-- Nút "Hiển thị tất cả" sẽ active khi không có domain nào được chọn --}}
                        <li class="{{ !$currentDomain ? 'active' : '' }}">
                            <a href="{{ route('destination') }}">Hiển thị tất cả</a>
                        </li>
                        {{-- Nút "Miền Bắc" sẽ active khi domain là 'b' --}}
                        <li class="{{ $currentDomain == 'b' ? 'active' : '' }}">
                            <a href="{{ route('destination', ['domain' => 'b']) }}">Miền Bắc</a>
                        </li>
                        {{-- Nút "Miền Trung" sẽ active khi domain là 't' --}}
                        <li class="{{ $currentDomain == 't' ? 'active' : '' }}">
                            <a href="{{ route('destination', ['domain' => 't']) }}">Miền Trung</a>
                        </li>
                        {{-- Nút "Miền Nam" sẽ active khi domain là 'n' --}}
                        <li class="{{ $currentDomain == 'n' ? 'active' : '' }}">
                            <a href="{{ route('destination', ['domain' => 'n']) }}">Miền Nam</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- DANH SÁCH CÁC ĐIỂM ĐẾN --}}
        <div class="row justify-content-center">
            @forelse ($cities as $city)
                {{-- Bỏ các class lọc của Isotope như 'item', 'domain-*' --}}
                <div class="col-xl-3 col-md-6">
                    <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500">
                        <div class="image">
                            <img src="{{ asset('clients/images/city/'.$city->thumbnail) }}" alt="{{ $city->name }}">
                        </div>
                        <div class="content">
                            <h6><a href="#">{{ $city->name }}</a></h6>
                            <span class="time">{{ $city->tours_count }}+ tours</span>
                            <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-12">Không có điểm đến nào phù hợp với lựa chọn của bạn.</p>
            @endforelse
        </div>

        {{-- HIỂN THỊ PHÂN TRANG --}}
        <div class="pagination-container d-flex justify-content-center mt-40">
            {{-- appends(request()->query()) sẽ giữ lại bộ lọc khi chuyển trang --}}
            {{-- {{ $cities->appends(request()->query())->links() }} --}}
              {{ $cities->appends(request()->query())->links('vendor.pagination.custom') }}
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
            @foreach ($tours as $tour)
                
            <div class="col-lg-4 col-md-6">
                <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <span class="badge">10% Off</span>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/images/gallery-tours/' . $tour->thumbnail->imageURL . '') }}" alt="Hot Deal">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->city->name }}</span>
                        <h5 class="text-tour-destination"><a href="{{ route('tour-detail', $tour->tourId) }}">{{ $tour->title }}</a></h5>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>{{ number_format($tour->priceAdult) }}</span>/Người</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <a href="{{ route('tour-detail', $tour->tourId) }}" class="theme-btn style-three">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
          
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
