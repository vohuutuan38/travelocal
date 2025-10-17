@extends('layouts.admin')
@section('title', 'Tạo Bài viết mới')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Tạo Bài viết mới</h5>
                <div class="">
                    <a href="{{ route('admin.listPost') }}" class="btn btn-primary btn-sm">Quay lại</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.storePost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="pending_review">Pending review</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Ảnh đại diện (Thumbnail)</label>
                        <input type="file" name="thumbnail" class="form-control post-image-input" accept="image/*"
                            data-preview="postPreview">
                        <div id="postPreview" class="mt-2 mb-4">
                            <img src="#" alt="Preview ảnh đại diện" class="img-fluid rounded d-none border"
                                style="max-width: 200px; height: auto;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Tóm tắt (Excerpt)</label>
                        <input type="text" name="excerpt" class="form-control">
                        {{-- <textarea name="excerpt" class="form-control" rows="3"></textarea> --}}
                    </div>
                    <div class="mb-3">
                        <label>Nội dung</label>
                        <textarea name="content" id="content-editor" class="form-control" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Gợi ý: Tích hợp một rich text editor như TinyMCE hoặc CKEditor cho #content-editor --}}
@endsection
