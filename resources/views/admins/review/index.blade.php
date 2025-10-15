@extends('layouts.admin')
@section('title', 'Quản lý Đánh giá')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Phân bổ đánh giá</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $totalReviews = $stats['distribution']->sum();
                        @endphp
                        @for ($i = 5; $i >= 1; $i--)
                            @php
                                $count = $stats['distribution']->get($i, 0);
                                $percent = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                            @endphp
                            <h4 class="small float-left font-weight-bold">{{ $i }} <i class="fas fa-star"></i>
                                <span class="">( {{ $count }} lượt )</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent }}%"
                                    aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card border-left-info shadow py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng số đánh giá</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                            </div>
                             <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rating trung bình
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['avg_rating'] }} <i
                                        class="fas fa-star text-warning"></i></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách đánh giá</h6>
                <a href="{{ route('admin.trashReview') }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-trash-alt"></i> Thùng rác
                </a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.listReview') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm theo bình luận, tên tour, tên người dùng..." value="{{ request('search') }}">
                        <select name="rating" class="form-select" style="max-width: 150px;">
                            <option value="">Tất cả rating</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(request('rating') == $i)>{{ $i }} sao
                                </option>
                            @endfor
                        </select>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-custom align-middle" >
                        <thead>
                            <tr>
                                <th>Người đánh giá</th>
                                <th>Tour</th>
                                <th class="text-center">Rating</th>
                                <th>Bình luận</th>
                                <th>Ngày</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr>
                                    <td>{{ $review->user->fullname ?? 'N/A' }}</td>
                                    {{-- <td>{{ Str::limit($review->tour->title ?? 'N/A', 30) }}</td> --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('clients/images/gallery-tours/' . $review->tour->thumbnail->imageURL ?? 'clients/images/gallery-tours//default-image.jpg') }}"
                                                alt="{{ $review->tour->title ?? 'Tour Image' }}" class="me-3"
                                                style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

                                            <div>
                                                <p class="mb-0 fw-bold">
                                                    {{ Str::limit($review->tour->title ?? 'N/A', 40) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-warning">
                                        @for ($i = 1; $i <= $review->average; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($review->comment, 80) }}</td>
                                    <td>{{ $review->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.deleteReview', $review) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có đánh giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">

                    {{ $reviews->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>

@endsection
