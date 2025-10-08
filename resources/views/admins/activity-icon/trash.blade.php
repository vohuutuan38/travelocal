@extends('layouts.admin')
@section('title', 'Thùng rác Icon')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-trash-alt"></i> Thùng rác Icon</h5>
                <a href="{{ route('admin.listIcon') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Quay
                    lại</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên hoạt động</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedIcons as $icon)
                            <tr>
                                <th scope="row">{{ $icon->activityIconId }}</th>
                                <td>{{ $icon->name }}</td>
                                <td><i class="{{ $icon->icon }} fa-2x"></i></td>
                                <td>{{ $icon->deleted_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    {{-- Đã cập nhật route, truyền vào $icon --}}
                                    <form action="{{ route('admin.restoreIcon', $icon) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                class="fas fa-trash-restore"></i> Khôi phục</button>
                                    </form>
                                    {{-- Đã cập nhật route, truyền vào $icon --}}
                                    <form action="{{ route('admin.forceDeleteIcon', $icon) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Hành động này không thể hoàn tác. Bạn có chắc chắn muốn xóa vĩnh viễn?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-times-circle"></i> Xóa vĩnh viễn</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Thùng rác trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $trashedIcons->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
