@extends('layouts.admin')
@section('title', 'Tour Edit')
@section('content')
    <div class="container-fluid ">
        <div class="card mb-4">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">✏️ Chỉnh sửa Tour: {{ $tour->title }}</h3>
            </div>
            <form action="{{ route('admin.updateTour', $tour->tourId) }}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="text-sm">Tiêu đề Tour</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $tour->title) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="text-sm">Tổng thời gian tour</label>
                        <input type="text" name="time" class="form-control" value="{{ old('time', $tour->time) }}"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="text-sm fw-bold">Vùng miền</label>
                        <select name="domain_filter" id="domain-select" class="form-select">
                            <option value="">-- Chọn vùng miền --</option>
                            <option value="b" {{ $tour->city->domain == 'b' ? 'selected' : '' }}>Miền Bắc</option>
                            <option value="t" {{ $tour->city->domain == 't' ? 'selected' : '' }}>Miền Trung</option>
                            <option value="n" {{ $tour->city->domain == 'n' ? 'selected' : '' }}>Miền Nam</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="text-sm fw-bold">Thành phố/Tỉnh</label>
                        <select name="cityId" id="city-select" class="form-select" required>
                            <option value="">-- Chọn thành phố --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->cityId }}" data-domain="{{ $city->domain }}"
                                    {{ $city->cityId == $tour->cityId ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->domainName }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-sm">Ngày bắt đầu</label>
                        <input type="date" name="startDate" class="form-control" value="{{ $tour->startDate }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-sm">Ngày kết thúc</label>
                        <input type="date" name="endDate" class="form-control" value="{{ $tour->endDate }}">
                    </div>

                    {{-- Ảnh tour --}}
                    <div class="mb-3">
                        <label class="form-label text-sm fw-bold">Ảnh tour (tối đa 5 ảnh)</label>
                        <div class="row g-3">
                            @php $images = $tour->images; @endphp
                            @for ($i = 0; $i < 5; $i++)
                                <div class="col-md-4">
                                    <input type="file" name="images[]" class="form-control image-input" accept="image/*">
                                    <div class="preview mt-2">
                                        @if (isset($images[$i]))
                                            <img src="{{ asset('clients/images/gallery-tours/' . $images[$i]->imageURL) }}"
                                                alt="Preview" class="img-fluid rounded border">
                                        @else
                                            <img src="" alt="Preview" class="img-fluid rounded border d-none">
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-sm">Số lượng người</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $tour->quantity }}">
                    </div>
                    <div class="col-md-4">
                        <label class="text-sm">Giá người lớn</label>
                        <input type="number" name="priceAdult" class="form-control" value="{{ $tour->priceAdult }}">
                    </div>
                    <div class="col-md-4">
                        <label class="text-sm">Giá trẻ em</label>
                        <input type="number" name="priceChild" class="form-control" value="{{ $tour->priceChild }}">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-sm">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4">{{ $tour->description }}</textarea>
                </div>

                {{-- Timeline --}}
                <div class="mt-4">
                    <label class="text-sm fw-semibold">📅 Lịch trình (Timeline)</label>
                    <div id="timeline-wrapper">
                        @foreach ($tour->timelines as $index => $timeline)
                            <div class="d-flex mb-2 timeline-item">
                                <input type="text" name="timelines[{{ $index }}][title]"
                                    value="{{ $timeline->title }}" class="form-control me-2 w-25">

                                <textarea name="timelines[{{ $index }}][description]" class="form-control me-2">{{ $timeline->description }}</textarea>

                                <button type="button" class="btn btn-danger remove-timeline">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        @endforeach

                        {{-- Trường thêm mới --}}
                        <div class="d-flex mb-2 timeline-item">
                            <input type="text" name="timelines[{{ count($tour->timelines) }}][title]"
                                placeholder="Ngày..." class="form-control me-2 w-25">
                            <textarea name="timelines[{{ count($tour->timelines) }}][description]" placeholder="Mô tả"
                                class="form-control me-2"></textarea>
                            <button type="button" class="btn btn-success add-timeline">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-sm">Link Google Map (iframe)</label>
                    <input type="text" name="map_link" class="form-control"
                        value="{{ optional($tour->locationMap)->map_link }}">
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="text-sm">✅ Bao gồm</label>
                        <textarea name="includes[]" class="form-control" rows="4">
                            @foreach ($tour->includes as $inc)
                            {{ $inc->content }}&#10;
                            @endforeach
                            </textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="text-sm">❌ Loại trừ</label>
                        <textarea name="excludes[]" class="form-control" rows="4">
                            @foreach ($tour->excludes as $exc)
                            {{ $exc->content }}&#10;
                            @endforeach
                            </textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="text-sm fw-semibold">🎯 Chọn hoạt động cho tour</label>
                    <div class="row">
                        @foreach ($activityIcons as $activity)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="activity_icons[]"
                                        value="{{ $activity->activityIconId }}" class="form-check-input"
                                        id="act{{ $activity->activityIconId }}"
                                        {{ in_array($activity->activityIconId, $tour->activities->pluck('activityIconId')->toArray()) ? 'checked' : '' }}>
                                    <label for="act{{ $activity->activityIconId }}" class="form-check-label">
                                        <i class="{{ $activity->icon }}"></i> {{ $activity->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-sm">Chọn hướng dẫn viên</label>
                    <select name="guides[]" class="form-select" >
                        @foreach ($guides as $guide)
                            <option value="{{ $guide->guideId }}"
                                {{ in_array($guide->guideId, $tour->guides->pluck('guideId')->toArray()) ? 'selected' : '' }}>
                                {{ $guide->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-4">Cập nhật Tour</button>
                </div>
            </form>
        </div>
    </div>
@endsection
