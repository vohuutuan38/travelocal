@extends('layouts.admin')
@section('title', 'Thùng rác - Đơn đặt tour')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-trash-alt me-2"></i>Thùng rác - Đơn đặt tour</h5>
            <a href="{{ route('admin.listBooking') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã Booking</th>
                            <th>Tên Tour</th>
                            <th>Khách hàng</th>
                            <th>Ngày xóa</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedBookings as $booking)
                            <tr>
                                <td><strong>#{{ $booking->bookingId }}</strong></td>
                                <td title="{{ $booking->tour->title ?? 'Tour không tồn tại' }}">
                                    {{ Str::limit($booking->tour->title ?? 'N/A', 40) }}
                                </td>
                                <td>{{ $booking->fullname }}</td>
                                <td>{{ $booking->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.restoreBooking', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success" title="Khôi phục">
                                            <i class="fas fa-trash-restore"></i> Khôi phục
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Thùng rác trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $trashedBookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection