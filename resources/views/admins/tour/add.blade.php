@extends('layouts.admin')
@section('title', 'Thêm Tour')
@section('content')
    <div class="container-fluid ">
        <div class="card mb-4">
            <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Thêm tour</h3>
                 
                </div>
            <form action="" method="POST" class="p-4">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Tiêu đề Tour</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ảnh tour (tối đa 5 ảnh)</label>

                        <div class="row g-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="col-md-4">
                                    <input type="file" name="images[]" class="form-control image-input" accept="image/*">
                                    <div class="preview mt-2">
                                        <img src="" alt="Preview" class="img-fluid rounded border d-none">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Giá người lớn</label>
                        <input type="number" name="priceAdult" class="form-control" required>
                    </div>
                     <div class="col-md-6">
                        <label>Giá trẻ em</label>
                        <input type="number" name="priceChild" class="form-control" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mt-3">
                    <label>Link Google Map (iframe)</label>
                    <input type="text" name="map_link" class="form-control">
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>✅ Bao gồm</label>
                        <textarea name="includes[]" class="form-control" placeholder="Mỗi dòng 1 mục"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>❌ Loại trừ</label>
                        <textarea name="excludes[]" class="form-control" placeholder="Mỗi dòng 1 mục"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="fw-semibold">🎯 Hoạt động</label>

                    <div id="activities-wrapper">
                        <div class="d-flex mb-2 activity-item">
                            <input type="text" name="activities[0][name]" placeholder="Tên hoạt động (vd: Leo núi)"
                                class="form-control me-2">
                            <input type="text" name="activities[0][icon]"
                                placeholder="Icon flaticon (vd: flaticon-hiking)" class="form-control me-2">
                            <button type="button" class="btn btn-success add-activity"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label>Chọn hướng dẫn viên</label>
                    <select name="guides[]"  class="form-select">
                        @foreach ($guides as $guide)
                            <option value="{{ $guide->guideId }}">{{ $guide->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Lưu Tour</button>
                </div>
            </form>

        </div>
    </div>
@endsection
