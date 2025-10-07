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
                        <form action="{{ route('admin.updateGuide', $guide->guideId) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="guide_name" class="form-label">Tên hướng dẫn viên</label>
                                <input type="text" class="form-control" id="guide_name" name="name"
                                    value="{{ old('name', $guide->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="guide_phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="guide_phone" name="phone"
                                    value="{{ old('phone', $guide->phone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="guide_bio" class="form-label">Tiểu sử</label>
                                <textarea class="form-control" id="guide_bio" name="bio" rows="4" required>{{ old('bio', $guide->bio) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="guide_avatar" class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control guide-edit-image" id="guide_avatar" name="avatar"
                                    accept="image/*" data-preview="guideEditAvatarPreview">
                            </div>

                            <div id="guideEditAvatarPreview" class=" mb-4">
                                @if ($guide->avatar)
                                    <img src="{{ asset('clients/images/guide/' . $guide->avatar) }}" alt="Ảnh hiện tại"
                                        class="img-fluid rounded border" style="max-width: 200px; height: auto;">
                                @else
                                    <img src="#" alt="Preview ảnh mới" class="img-fluid rounded border d-none"
                                        style="max-width: 200px; height: auto;">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                            <a href="{{ route('admin.listGuide') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
