@extends('layouts.admin')
@section('title', 'Quản lý Icon Hoạt động')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-icons"></i>  Quản lý Icon Hoạt động</h5>
            <div>
                <a href="{{ route('admin.trashIcon') }}" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt"></i> Thùng rác</a>
                <a href="{{ route('admin.createIcon') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Thêm mới</a>
            </div>
        </div>
        <div class="card-body">
       
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên hoạt động</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($icons as $icon)
                        <tr>
                            <th scope="row">{{ $icon->activityIconId }}</th>
                            <td>{{ $icon->name }}</td>
                            <td>{!! $icon->icon !!} </td>
                            <td>
                                <a href="{{ route('admin.editIcon', $icon) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                <form action="{{ route('admin.deleteIcon', $icon) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa icon này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Chưa có icon nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                       {{ $icons->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection