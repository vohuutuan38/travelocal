@extends('layouts.admin')
@section('title', 'thùng rác')
@section('content')

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Thùng rác - Đánh giá</h6>
            <a href="{{ route('admin.listReview') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Người đánh giá</th>
                            <th>Tour</th>
                            <th>Bình luận</th>
                            <th>Ngày xóa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedReviews as $review)
                        <tr>
                            <td>{{ $review->user->fullname ?? 'N/A' }}</td>
                            <td>{{ Str::limit($review->tour->title ?? 'N/A', 30) }}</td>
                            <td>{{ Str::limit($review->comment, 80) }}</td>
                            <td>{{ $review->deleted_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.restoreReview', $review) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="fas fa-trash-restore"></i> Khôi phục
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Thùng rác trống.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
        
                {{ $trashedReviews->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection