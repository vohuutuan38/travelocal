@extends('layouts.admin')
@section('title', 'Cập nhật Icon Hoạt động')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-edit"></i> Cập nhật Icon Hoạt động</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updateIcon', $icon) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Tên hoạt động</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $icon->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Class Icon (ví dụ: fas fa-swimmer)</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $icon->icon) }}">
                     @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                <a href="{{ route('admin.listIcon') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection