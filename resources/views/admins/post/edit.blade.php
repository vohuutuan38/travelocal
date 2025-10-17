@extends('layouts.admin')
@section('title', 'Chỉnh sửa Bài viết')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Chỉnh sửa: {{ $post->title }}</h5>
            <div class="">
                <a href="{{ route('admin.listPost') }}" class="btn btn-primary btn-sm">Quay lại</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updatePost', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                </div>
                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="published" @selected($post->status == 'published')>Published</option>
                            <option value="draft" @selected($post->status == 'draft')>Draft</option>
                            <option value="pending_review" @selected($post->status == 'pending_review')>Pending review</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Ảnh đại diện (Thumbnail)</label>
                    <input type="file" name="thumbnail" class="form-control post-edit-image" data-preview="postEditPreview" accept="image/*">
                    <div id="postEditPreview" class=" mb-4">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('clients/images/blog/' .$post->thumbnail) }}" alt="Ảnh hiện tại"
                                        class="img-fluid rounded border" style="max-width: 200px; height: auto;">
                                @else
                                    <img src="#" alt="Preview ảnh mới" class="img-fluid rounded border d-none"
                                        style="max-width: 200px; height: auto;">
                                @endif
                            </div>
                </div>
                <div class="mb-3">
                    <label>Tóm tắt (Excerpt)</label>
                    <input type="text" name="excerpt" class="form-control" value="{{ $post->excerpt }}">
                    
                </div>
                 <div class="mb-3">
                    <label>Nội dung</label>
                    <textarea name="content" id="content-editor" class="form-control" rows="10">{{ $post->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection