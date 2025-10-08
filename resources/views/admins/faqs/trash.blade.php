@extends('layouts.admin')
@section('title', 'Thùng rác FAQ')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Thùng rác - Câu hỏi đã xóa</h5>
            <a href="{{ route('admin.listFaqs') }}" class="btn btn-secondary btn-sm">Quay lại danh sách</a>
        </div>
        <div class="card-body">
        
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Câu hỏi</th>
                        <th>Ngày xóa</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $key => $faq)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->deleted_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.restoreFaqs', $faq->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.forceDeleteFaqs', $faq->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Xóa vĩnh viễn?')" class="btn btn-sm btn-danger">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">Không có câu hỏi nào trong thùng rác.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
