@extends('layouts.admin')
@section('title', 'Thêm Tour')
@section('content')
    <div class="container-fluid ">
        <div class="card mb-4">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Thêm tour</h3>

            </div>
            <form action="{{ route('admin.storeTour') }}" method="POST" class="p-4">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="text-sm">Tiêu đề Tour</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="text-sm">Tổng thời gian tour</label>
                        <input type="text" name="time" class="form-control" required>
                    </div>
                   <div class="col-md-4 mb-3">
                        <label class="text-sm fw-bold">Vùng miền <span class="text-danger">*</span></label>
                        <select name="domain_filter" id="domain-select" class="form-select">
                            <option value="">-- Chọn vùng miền --</option>
                            <option value="b">Miền Bắc</option>
                            <option value="t">Miền Trung</option>
                            <option value="n">Miền Nam</option>
                        </select>
                        <small class="text-muted">Chọn vùng miền để lọc danh sách thành phố</small>
                    </div>

                    <!-- Thành phố/Tỉnh -->
                    <div class="col-md-4 mb-3">
                        <label class="text-sm fw-bold">Thành phố/Tỉnh <span class="text-danger">*</span></label>
                        <select name="cityId" 
                                id="city-select" 
                                class="form-select @error('cityId') is-invalid @enderror"
                                required>
                            <option value="">-- Chọn thành phố --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->cityId }}" 
                                        data-domain="{{ $city->domain }}"
                                        {{ old('cityId') == $city->cityId ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->domainName }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-sm">Ngày bắt đầu</label>
                        <input type="date" name="startDate " class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-sm">Ngày kết thúc</label>
                        <input type="date" name="endDate" class="form-control" required>
                    </div>
                    <div class="mb-3 mb-3">
                        <label class="form-label text-sm fw-bold">Ảnh tour (tối đa 5 ảnh)</label>

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
                    <div class="col-md-4">
                        <label class="text-sm">Số lượng người</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="text-sm">Giá người lớn</label>
                        <input type="number" name="priceAdult" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="text-sm">Giá trẻ em</label>
                        <input type="number" name="priceChild" class="form-control" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-sm">Mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mt-3">
                    <label class="text-sm">Link Google Map (iframe)</label>
                    <input type="text" name="map_link" class="form-control">
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="text-sm">✅ Bao gồm</label>
                        <textarea name="includes[]" class="form-control" placeholder="Mỗi dòng 1 mục"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm">❌ Loại trừ</label>
                        <textarea name="excludes[]" class="form-control" placeholder="Mỗi dòng 1 mục"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <label class=" text-sm fw-semibold">🎯 Hoạt động ( <a href="https://www.flaticon.com/">Lấy icon tại
                            đây</a> )</label>

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
                    <label class="text-sm">Chọn hướng dẫn viên</label>
                    <select name="guides[]" class="form-select">
                        @foreach ($guides as $guide)
                            <option value="{{ $guide->guideId }}">{{ $guide->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Lưu Tour</button>
                </div>
            </form>

        </div>
    </div>
@endsection
