@extends('layouts.admin')
@section('title', 'Sửa câu hỏi')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header"><h5>Sửa câu hỏi</h5></div>
        <div class="card-body">
            <form action="{{ route('admin.updateFaqs', $faq->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Câu hỏi</label>
                    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Trả lời</label>
                    <textarea name="answer" class="form-control" rows="4" required>{{ $faq->answer }}</textarea>
                </div>
                <a href="{{ route('admin.listFaqs') }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
