@extends('layouts.admin')
@section('title', 'Thêm Icon Hoạt động')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-plus-circle"></i> Thêm Icon Hoạt động</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.storeIcon') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên hoạt động</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Class Icon (ví dụ: fas fa-swimmer)</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}">
                     @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                <a href="{{ route('admin.listIcon') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection