@extends('layouts.client')
@section('title', 'Danh sách blog')
@section('content')

    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
        <div class="container">
            <div class="banner-inner text-white">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Danh sách blog
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách blog</li>
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
                    {{-- Bắt đầu vòng lặp để hiển thị mỗi bài viết --}}
                    @forelse ($posts as $post)
                        <div class="blog-item style-three" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                {{-- Lấy ảnh thumbnail của bài viết --}}
                                <img src="{{ $post->thumbnail ? asset('clients/images/blog/' . $post->thumbnail) : asset('clients/images/blog/blog-list1.jpg') }}"
                                    alt="{{ $post->title }}" class="image-fixed-size">
                            </div>
                            <div class="content">
                                {{-- Lấy tên danh mục và link đến trang danh mục --}}
                                @if ($post->category)
                                    <a href="" class="category">{{ $post->category->name }}</a>
                                @endif

                                {{-- Lấy tiêu đề và link đến trang chi tiết bài viết --}}
                                <h5><a href="">{{ $post->title }}</a></h5>

                                <ul class="blog-meta">
                                    {{-- Lấy ngày xuất bản --}}
                                    <li>
                                        <i class="far fa-calendar-alt"></i>
                                        {{-- Dùng 'as Carbon\Carbon' trong view nếu cần, hoặc '->translatedFormat' nếu dùng Carbon language pack --}}
                                        <a href="#">{{ optional($post->published_at)->format('d/m/Y') }}</a>
                                    </li>
                                    {{-- (Tùy chọn) Lấy tên tác giả --}}
                                    @if ($post->author)
                                        <li><i class="far fa-user"></i> <a href="#">{{ $post->author->userName }}</a>
                                        </li>
                                    @endif
                                </ul>

                                {{-- Lấy đoạn tóm tắt (excerpt) --}}
                                <p>{{ $post->excerpt }}</p>

                                <a href="" class="theme-btn style-two style-three">
                                    <span data-hover="Đọc thêm">Đọc thêm</span>
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        {{-- Hiển thị thông báo nếu không có bài viết nào --}}
                        <div class="alert alert-warning text-center">
                            <h4>Không tìm thấy bài viết nào.</h4>
                            <p>Hiện tại chưa có bài viết nào trong chuyên mục này. Vui lòng quay lại sau.</p>
                        </div>
                    @endforelse

                    {{-- Hiển thị các nút phân trang --}}
                    <div class="pagination-container d-flex justify-content-center mt-4">
                   
                          {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                    <div class="blog-sidebar">

                        {{-- 1. Widget Tìm kiếm --}}
                        <div class="widget widget-search" data-aos="fade-up" data-aos-duration="1500">
                            {{-- Form action trỏ đến route blog.index với method GET --}}
                            <form action="{{ route('blog') }}" method="GET" class="default-search-form">
                                <input type="text" name="search" placeholder="Tìm kiếm bài viết..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="searchbutton far fa-search"></button>
                            </form>
                        </div>

                        {{-- 2. Widget Danh mục --}}
                        @if ($categories->isNotEmpty())
                            <div class="widget widget-category" data-aos="fade-up" data-aos-duration="1500">
                                <h5 class="widget-title">Danh mục</h5>
                                <ul class="list-style-three">
                                    {{-- Dùng vòng lặp để hiển thị các danh mục --}}
                                    @foreach ($categories as $category)
                                        <li><a href="">{{ $category->name }} ({{ $category->posts_count }})</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- 3. Widget Tin tức gần đây --}}
                        @if ($recentPosts->isNotEmpty())
                            <div class="widget widget-news" data-aos="fade-up" data-aos-duration="1500">
                                <h5 class="widget-title">Bài viết gần đây</h5>
                                <ul>
                                    {{-- Dùng vòng lặp để hiển thị các bài viết mới --}}
                                    @foreach ($recentPosts as $post)
                                        <li>
                                            <div class="image">
                                                <img src="{{ $post->thumbnail ? asset('clients/images/blog/' . $post->thumbnail) : asset('clients/images/blog/blog-list1.jpg') }}"
                                                    alt="{{ $post->title }}" class="image-sidebar-fixed-size">
                                            </div>
                                            <div class="content">
                                                <h6><a href="">{{ Str::limit($post->title, 40) }}</a></h6>
                                                <span class="date"><i class="far fa-calendar-alt"></i>
                                                    {{ $post->published_at->format('d M Y') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- 4. Widget Gallery --}}
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

                        {{-- 5. Widget CTA (Call to Action) - Phần này thường là tĩnh nên giữ nguyên --}}
                        <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500">
                            <div class="content text-white">

                                <span class="h6">Khám phá thế giới</span>

                                <h3>Địa điểm du lịch tốt nhất</h3>

                                <a href="tour-list.html" class="theme-btn style-two bgc-secondary">

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
        </div>
    </section>
    <!-- Blog List Area end -->
@endsection
