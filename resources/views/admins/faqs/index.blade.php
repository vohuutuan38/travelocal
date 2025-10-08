@extends('layouts.admin')
@section('title', 'Danh sách FAQ')
@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách câu hỏi thường gặp</h5>
            <div>
                <a href="{{ route('admin.createFaqs') }}" class="btn btn-primary btn-sm">+ Thêm mới</a>
                <a href="{{ route('admin.trashFaqs') }}" class="btn btn-secondary btn-sm">Thùng rác</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Câu hỏi</th>
                        <th scope="col">Trả lời</th>
                        <th scope="col">Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $key => $faq)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ Str::limit($faq->answer, 100) }}</td>
                        <td>{{ $faq->created_at->format('d/m/Y') }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.editFaqs', $faq->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.deleteFaqs', $faq->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Xóa mềm câu hỏi này?')" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">Chưa có câu hỏi nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
