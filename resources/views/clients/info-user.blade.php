@include('clients.blocks.header')
<div class="container-xl px-4 my-115">
    <div class="row">
        <div class="col-xl-4">
            {{-- <img class="img-account-profile rounded-circle mb-2"
                            src="{{ asset('clients/images/avatar/'.$user->avatar) }}" alt> --}}

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Thông tin cá nhân</div>
                <div class="card-body text-center">
                    <form action="{{ route('user.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ $user->avatar ? asset('clients/images/avatar/' . $user->avatar) : asset('clients/images/avatar/avatar-default.png') }}"
                            alt="avatar">

                        <div class="small font-italic text-muted mb-4">
                            {{ $user->avatar ? '' : 'Chưa có ảnh đại diện' }}
                        </div>

                        <input type="file" class="form-control mb-3" name="avatar" id="avatar">
                        <button class="btn btn-primary" type="submit">Upload ảnh mới</button>
                    </form>

                </div>
                  <!-- Nút để bật/tắt form đổi mật khẩu -->
    <div class="card-body text-center">
        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#changePasswordForm" aria-expanded="false" aria-controls="changePasswordForm">
            Đổi mật khẩu
        </button>

        <!-- Form đổi mật khẩu (ẩn mặc định) -->
        <div class="collapse mt-3" id="changePasswordForm">
            <form action="{{ route('user.changePassword') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="small mb-1" for="current_password">Mật khẩu hiện tại</label>
                    <input class="form-control" id="current_password" name="current_password" type="password"
                        placeholder="Nhập mật khẩu cũ" required>
                    @error('current_password')
                        <div style="color:red; margin-top: 1px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="small mb-1" for="new_password">Mật khẩu mới</label>
                    <input class="form-control" id="new_password" name="new_password" type="password"
                        placeholder="Nhập mật khẩu mới" required>
                    @error('new_password')
                        <div style="color:red; margin-top: 1px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="small mb-1" for="new_password_confirmation">Xác nhận mật khẩu</label>
                    <input class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                        type="password" placeholder="Nhập lại mật khẩu mới" required>
                </div>

                <button class="btn btn-primary" type="submit">Thay đổi mật khẩu</button>
            </form>
        </div>
    </div>
            </div>
        </div>
        <div class="col-xl-8">

            <div class="card mb-4">
                <div class="card-header">Chi tiết tài khoản</div>
                <div class="card-body">
                    <form action="{{ route('user.updateDetail', $user->userId) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tên tài khoản</label>
                            <input class="form-control" id="inputUsername" type="text" name="userName"
                                placeholder="Điền tên người dùng" value="{{ $user->userName }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tên đầy đủ</label>
                            <input class="form-control" id="inputUsername" type="text" name="fullname"
                                placeholder="Điền tên người dùng" value="{{ $user->fullname }}">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                            <input class="form-control" id="inputLocation" type="text" name="address"
                                placeholder="điền địa chỉ" value="{{ $user->address }}">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                placeholder="điền email" value="{{ $user->email }}">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                            <input class="form-control" id="inputPhone" type="tel" name="phoneNumber"
                                placeholder="điền số điện thoại của bạn" value="{{ $user->phoneNumber }}">
                        </div>

                        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@include('clients.blocks.footer')
