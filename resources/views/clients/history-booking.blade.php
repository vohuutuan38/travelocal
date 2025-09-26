@include('clients.blocks.header')
<section class="page-banner-tour pt-50 pb-35 rel z-1 bgs-cover"
    style="background-image: url({{ asset('clients/images/banner/banner.jpg') }});">
    <div class="container">
        <div class="banner-inner text-white">
            <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                Danh sách đặt Tour</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                    data-aos-duration="1500" data-aos-offset="50">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách đặt tour</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<div class="container  container-1400 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-history text-primary"></i> Lịch sử Giao dịch</h2>
            <p class="text-muted mb-0">Quản lý và theo dõi các giao dịch tour du lịch</p>
        </div>

    </div>

    <!-- Filter Section -->
    <div class="filter-section mb-10">
        <div class="row g-3 d-flex justify-content-between align-items-center">
            <div class="col-md-2">
                <label class="form-label">Từ ngày</label>
                <input type="date" class="form-control" id="fromDate">
            </div>
            <div class="col-md-2">
                <label class="form-label">Đến ngày</label>
                <input type="date" class="form-control" id="toDate">
            </div>
            <div class="col-md-3">
                <label class="form-label">Trạng thái</label>
                <select name="city" id="city">
                    <option value="value1">Hoàn thành</option>
                    <option value="value2">Chờ xử lý</option>
                    <option value="value2">Đã hủy</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tìm kiếm</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mã giao dịch, tour..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Lọc
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-undo"></i> Đặt lại
                </button>
            </div>
        </div>

    </div>



    <!-- Transaction List -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách giao dịch</h5>

        </div>
        <div class="card-body p-0">
            <!-- Transaction Item 1 -->
            @foreach ($historys as $history)
                <div class="transaction-card p-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=200&h=150"
                                alt="Tour Đà Lạt" class="tour-image">
                        </div>
                        <div class="col-md-3">
                            <h6 class="mb-1">{{ $history->tour->title }}</h6>
                            <p class="mb-1 text-muted small">Mã: TDL001</p>
                            <p class="mb-0 date-text">{{ $history->tour->startDate }}</p>
                        </div>
                        <div class="col-md-2">
                            <p class="mb-1"><strong>Khách hàng:</strong></p>
                            <p class="mb-0">{{ $history->fullname }}</p>
                            <p class="mb-0 small text-muted">{{ $history->phone }}</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="mb-1 amount-text text-success">{{ $history->totalPrice }}</p>
                            <p class="mb-0 small text-muted">Người lớn:{{ $history->numAdults }} </p>
                            <p class="mb-0 small text-muted">Trẻ em:{{ $history->numChildren }}</p>

                        </div>
                        <div class="col-md-1 text-center">
                            <span
                                class="badge {{ $history->bookingStatus == 'completed' ? 'bg-success'  : ($history->bookingStatus == 'pending'  ? 'bg-warning' : 'bg-danger') }} status-badge">
                                {{ ucfirst($history->bookingStatus) }}
                            </span>
                            <p class="mb-0 date-text mt-1">
                                {{ $history->checkout?->paymentDate ?? 'Chưa thanh toán' }}
                            </p>
                        </div>
                        <div class="col-md-2 text-end">
                            <a class="btn btn-danger">Hủy tour</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết giao dịch #TDL001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Thông tin tour</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td>Tên tour:</td>
                                <td>Tour Đà Lạt 3N2Đ</td>
                            </tr>
                            <tr>
                                <td>Mã tour:</td>
                                <td>TDL001</td>
                            </tr>
                            <tr>
                                <td>Ngày khởi hành:</td>
                                <td>15/11/2025</td>
                            </tr>
                            <tr>
                                <td>Số người:</td>
                                <td>2 người</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Thông tin khách hàng</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td>Họ tên:</td>
                                <td>Nguyễn Văn A</td>
                            </tr>
                            <tr>
                                <td>Điện thoại:</td>
                                <td>0987654321</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>nguyenvana@email.com</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ:</td>
                                <td>Hà Nội</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6>Thông tin thanh toán</h6>
                        <table class="table table-sm">
                            <tr>
                                <td>Giá tour (2 người):</td>
                                <td class="text-end">5,000,000 VND</td>
                            </tr>
                            <tr>
                                <td>Phí dịch vụ:</td>
                                <td class="text-end">300,000 VND</td>
                            </tr>
                            <tr>
                                <td>Thuế VAT (10%):</td>
                                <td class="text-end">200,000 VND</td>
                            </tr>
                            <tr class="table-info fw-bold">
                                <td>Tổng cộng:</td>
                                <td class="text-end">5,500,000 VND</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-print"></i> In hóa đơn
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
