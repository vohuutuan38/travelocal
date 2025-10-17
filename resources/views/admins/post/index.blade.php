@extends('layouts.admin')
@section('title', 'Quản lý Bài viết')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách Bài viết</h5>
            <div>
                <a href="{{ route('admin.createPost') }}" class="btn btn-primary btn-sm">Thêm mới</a> 
                <a href="{{ route('admin.trashPost') }}" class="btn btn-warning btn-sm">Thùng rác</a>
            </div>
        </div>
        <div class="card-body">
             {{-- Search form --}}
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('clients/images/blog/' . $post->thumbnail) }}" class="avatar avatar-sm me-3" alt="user1">
                                <h6 class="mb-0 text-sm">{{ Str::limit($post->title, 50) }}</h6>
                            </div>
                        </td>
                        <td>{{ $post->category->name ?? 'N/A' }}</td>
                        <td><span class="badge bg-{{ $post->status == 'published' ? 'success' : ($post->status == 'pending_review' ? 'warning' : 'secondary') }}">{{ $post->status }}</span></td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.editPost', $post) }}" class="btn btn-info btn-sm">Sửa</a>
                            <form action="{{ route('admin.deletePost', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Chuyển vào thùng rác?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Chưa có bài viết nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3"> {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}</div>
        </div>
    </div>
</div>
@endsection