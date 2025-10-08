@extends('layouts.admin')
@section('title', 'Thêm câu hỏi mới')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header"><h5>Thêm câu hỏi mới</h5></div>
        <div class="card-body">
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Câu hỏi</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Trả lời</label>
                    <textarea name="answer" class="form-control" rows="4" required></textarea>
                </div>
                <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection
