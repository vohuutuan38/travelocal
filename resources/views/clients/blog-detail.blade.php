@extends('layouts.client')
@section('title', 'blog details')
@section('content')

<!-- Page Banner Start -->
<section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover" style="background-image: url({{ asset('clients/images/banner/banner.jpg')}});">
    <div class="container">
        <div class="banner-inner text-white">
            <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">{{ $post->title }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Chi tiết bài viết</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->


<!-- Blog Detaisl Area start -->
<section class="blog-detaisl-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <a href="blog.html" class="category">{{ $post->category->name }}</a>
                    <ul class="blog-meta mb-30">
                        <li><img src="{{ asset('clients/images/blog/admin.jpg')}}" alt="Admin"> <a href="#">{{ $post->author->userName }}</a></li>
                        <li><i class="far fa-calendar-alt"></i> <a href="#">{{ optional($post->published_at)->format('d/m/Y') }}</a></li>
                       
                    </ul>
                    <p>{!! $post->content !!}</p>
                   
                  
                </div>
                    
                <hr class="mb-45">

                <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-25" name="review-form" action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h5>Leave A Comments</h5>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <div class="row gap-20 mt-30">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="full-name" name="full-name" class="form-control" placeholder="Name" value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" id="email-address" name="email" class="form-control" placeholder="Email" value="" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                               <ul class="radio-filter mb-25">
                                    <li>
                                        <input class="form-check-input" type="radio" name="terms-condition" id="terms-condition">
                                        <label for="terms-condition">Save my name, email, and website in this browser for the next time I comment.</label>
                                    </li>
                                </ul>
                                <button type="submit" class="theme-btn style-two">
                                    <span data-hover="Send Comments">Send Comments</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                    
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                    <div class="blog-sidebar">
                        {{-- Widget Tìm kiếm --}}
                        <div class="widget widget-search" data-aos="fade-up">
                            <form action="{{ isset($category) ? route('blog.category', $category->slug) : route('blog') }}"
                                method="GET" class="default-search-form">
                                <input type="text" name="search" placeholder="Tìm kiếm bài viết..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="searchbutton far fa-search"></button>
                            </form>
                        </div>

                        {{-- Widget Danh mục --}}
                        @if ($categories->isNotEmpty())
                            <div class="widget widget-category" data-aos="fade-up">
                                <h5 class="widget-title">Danh mục</h5>
                                <ul class="list-style-three">
                                    @foreach ($categories as $cat)
                                        {{-- Link đến trang danh mục --}}
                                        <li><a href="{{ route('blog.category', $cat->slug) }}" class="{{ isset($category->name) && $category->name == $cat->name ? 'text-secondary' : '' }}" >{{ $cat->name }}
                                                ({{ $cat->posts_count }})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Widget Tin tức gần đây --}}
                        @if ($recentPosts->isNotEmpty())
                            <div class="widget widget-news" data-aos="fade-up">
                                <h5 class="widget-title">Bài viết gần đây</h5>
                                <ul>
                                    @foreach ($recentPosts as $recentPost)
                                        <li>
                                            <div class="image">
                                                <img src="{{ asset('clients/images/blog/' . $recentPost->thumbnail ?? 'clients/images/blog/default.jpg') }}"
                                                    alt="{{ $recentPost->title }}" class="image-sidebar-fixed-size">
                                            </div>
                                            <div class="content">
                                                {{-- Link đến trang chi tiết bài viết --}}
                                                <h6><a
                                                        href="{{ route('blog.show', $recentPost->slug) }}">{{ Str::limit($recentPost->title, 40) }}</a>
                                                </h6>
                                                <span class="date"><i class="far fa-calendar-alt"></i>
                                                    {{ $recentPost->published_at->format('d M Y') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Các widget khác (Gallery, CTA) giữ nguyên --}}
                        @if ($galleryImages->isNotEmpty())

                            <div class="widget widget-gallery" data-aos="fade-up" data-aos-duration="1500">

                                <h5 class="widget-title">Gallery</h5>

                                <div class="gallery">

                                    {{-- Dùng vòng lặp để hiển thị ảnh --}}

                                    @foreach ($galleryImages as $imageUrl)
                                        <a href="">

                                            <img src="{{ asset('clients/images/blog/' . $imageUrl) }}" alt="Gallery"
                                                class="image-gallery-fixed-size">

                                        </a>
                                    @endforeach

                                </div>

                            </div>

                        @endif
                        <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500">

                            <div class="content text-white">
                                <span class="h6">Khám phá thế giới</span>
                                <h3>Địa điểm du lịch tốt nhất</h3>
                                <a href="{{ route('tour') }}" class="theme-btn style-two bgc-secondary">
                                    <span data-hover="Khám phá ngay">Khám phá ngay</span>
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="image">
                                <img src="{{ asset('clients/images/widgets/cta-widget.png') }}" alt="CTA">
                            </div>
                            <div class="cta-shape"><img src="{{ asset('clients/images/widgets/cta-shape.png') }}"
                                    alt="Shape"></div>
                        </div>


                    </div>
                </div>
        </div>
    </div>
</section>
<!-- Blog Detaisl Area end -->
@endsection
