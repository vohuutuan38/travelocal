@extends('layouts.admin')
@section('title', 'Thùng rác - Bài viết')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thùng rác - Bài viết</h5>
            <a href="{{ route('admin.listPost') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
        <div class="card-body">
           

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Ngày xóa</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($post->thumbnail)
                                        <img src="{{ asset('clients/images/blog/' . $post->thumbnail) }}" class="avatar avatar-sm me-3" alt="{{ $post->title }}">
                                    @endif
                                    <h6 class="mb-0 text-sm">{{ Str::limit($post->title, 50) }}</h6>
                                </div>
                            </td>
                            <td>{{ $post->category->name ?? 'N/A' }}</td>
                            <td>{{ $post->deleted_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                {{-- Form Khôi phục --}}
                                <form action="{{ route('admin.restorePost', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                                </form>

                                {{-- Form Xóa vĩnh viễn --}}
                                <form action="{{ route('admin.forceDeletePost', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Hành động này không thể hoàn tác. Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Thùng rác trống.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Phân trang --}}
            @if ($posts->hasPages())
                <div class="mt-3">
            
                      {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection