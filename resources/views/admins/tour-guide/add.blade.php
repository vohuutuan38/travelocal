@extends('layouts.admin')
@section('title', 'tour-guide')
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Thêm người hướng dẫn tour</h6>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('admin.storeGuide') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="guide_name" class="form-label">Tên hướng dẫn viên</label>
                                <input type="text" class="form-control" id="guide_name" name="name" required
                                    placeholder="Nhập tên hướng dẫn viên">
                            </div>

                            <div class="mb-3">
                                <label for="guide_phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="guide_phone" name="phone" required
                                    placeholder="Nhập số điện thoại">
                            </div>

                            <div class="mb-3">
                                <label for="guide_bio" class="form-label">Tiểu sử</label>
                                <textarea class="form-control" id="guide_bio" name="bio" rows="4" required
                                    placeholder="Nhập tiểu sử ngắn của hướng dẫn viên..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="guide_avatar" class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control guide-image-input" id="guide_avatar"
                                    name="avatar" accept="image/*" data-preview="guideAvatarPreview">
                                    <div id="guideAvatarPreview" class="mt-2 mb-4">
                                        <img src="#" alt="Preview ảnh đại diện" class="img-fluid rounded d-none border"
                                            style="max-width: 200px; height: auto;">
                                    </div>
                            </div>
                          
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Thêm Hướng Dẫn Viên
                                </button>
                                <a href="{{ route('admin.listGuide') }}" class="btn btn-secondary">
                                    Quay lại
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
