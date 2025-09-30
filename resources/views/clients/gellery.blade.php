@extends('layouts.client')
@section('title', 'Gallery')
@section('content')

<!-- Page Banner Start -->
<section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover" style="background-image: url({{ asset('clients/images/banner/banner.jpg')}});">
    <div class="container">
        <div class="banner-inner text-white">
            <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Gallery Slider</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Gallery Slider</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->


<!-- Gallery Area start -->
<section class="gallery-slider-area py-100 rel z-1">
    <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
        <h2>Explore Our Photo Gallery</h2>
        <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience you’ll remember</p>
    </div>
    <div class="gallery-slider-active">
        <div class="gallery-three-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <img src="{{ asset('clients/images/gallery/gallery-slider1.jpg')}}" alt="Gallery">
            </div>
            <div class="content">
                <span class="category">Tour & Travel</span>
                <h5><a href="destination-details.html">Brown Concrete Building</a></h5>
            </div>
        </div>
        <div class="gallery-three-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <img src="{{ asset('clients/images/gallery/gallery-slider2.jpg')}}" alt="Gallery">
            </div>
            <div class="content">
                <span class="category">Tour & Travel</span>
                <h5><a href="destination-details.html">Brown Concrete Building</a></h5>
            </div>
        </div>
        <div class="gallery-three-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <img src="{{ asset('clients/images/gallery/gallery-slider3.jpg')}}" alt="Gallery">
            </div>
            <div class="content">
                <span class="category">Tour & Travel</span>
                <h5><a href="destination-details.html">Brown Concrete Building</a></h5>
            </div>
        </div>
        <div class="gallery-three-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <img src="{{ asset('clients/images/gallery/gallery-slider4.jpg')}}" alt="Gallery">
            </div>
            <div class="content">
                <span class="category">Tour & Travel</span>
                <h5><a href="destination-details.html">Brown Concrete Building</a></h5>
            </div>
        </div>
        <div class="gallery-three-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
            <div class="image">
                <img src="{{ asset('clients/images/gallery/gallery-slider5.jpg')}}" alt="Gallery">
            </div>
            <div class="content">
                <span class="category">Tour & Travel</span>
                <h5><a href="destination-details.html">Brown Concrete Building</a></h5>
            </div>
        </div>
    </div>
</section>
<!-- Gallery Area end -->


<!-- Newsletter Area start -->
<section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url({{ asset('clients/images/newsletter/newsletter-bg-lines.png')}});">
    <div class="container container-1500">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-45">
                        <h2>Subscribe Our Newsletter to Get more offer & Tips</h2>
                        <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience you’ll remember</p>
                    </div>
                    <form class="newsletter-form mb-15" action="#">
                        <input id="news-email" type="email" placeholder="Email Address" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Subscribe">Subscribe</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                    <p>No credit card requirement. No commitments</p>
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
