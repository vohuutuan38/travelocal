@extends('layouts.client')
@section('title', 'Danh sách blog')
@section('content')

    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
        <div class="container">
            <div class="banner-inner text-white">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Danh sách blog 
                     @if (isset($category))
                            {{ $category->name }}
                    @else
                        
                    @endif
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách blog
                             
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Blog List Area start -->
    <section class="blog-list-page py-100 rel z-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- Thêm tiêu đề động --}}

                    @forelse ($posts as $post)
                        <div class="blog-item style-three" data-aos="fade-up" data-aos-duration="1500">
                            <div class="image">
                                <img src="{{ asset('clients/images/blog/' . $post->thumbnail ?? 'clients/images/blog/default.jpg') }}"
                                    alt="{{ $post->title }}" class="image-fixed-size">
                            </div>
                            <div class="content">
                                @if ($post->category)
                                    {{-- Link đến trang danh mục --}}
                                    <a href="{{ route('blog.category', $post->category->slug) }}"
                                        class="category">{{ $post->category->name }}</a>
                                @endif
                                {{-- Link đến trang chi tiết bài viết --}}
                                <h5><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h5>
                                <ul class="blog-meta">
                                    <li><i class="far fa-calendar-alt"></i> <a
                                            href="#">{{ optional($post->published_at)->format('d/m/Y') }}</a></li>
                                    @if ($post->author)
                                        <li><i class="far fa-user"></i> {{ $post->author->userName ?? 'Admin' }}</li>
                                    @endif
                                </ul>
                                <p>{{ $post->excerpt }}</p>
                                {{-- Link đến trang chi tiết bài viết --}}
                                <a href="{{ route('blog.show', $post->slug) }}" class="theme-btn style-two style-three">
                                    <span data-hover="Đọc thêm">Đọc thêm</span><i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center">
                            <h4>Không tìm thấy bài viết nào.</h4>
                            <p>Hiện tại chưa có bài viết nào trong chuyên mục này. Vui lòng quay lại sau.</p>
                        </div>
                    @endforelse

                    <div class="pagination-container d-flex justify-content-center mt-4">
                  
                         {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
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
    <!-- Blog List Area end -->
@endsection
