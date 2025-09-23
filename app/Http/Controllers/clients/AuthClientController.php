<?php

namespace App\Http\Controllers\clients;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    public function index()
    {
        $title = "Thông tin cá nhân";
        $user = Auth::user();
        return view('clients.info-user', compact('title', 'user'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();

        // Xóa avatar cũ nếu có
        if ($user->avatar && file_exists(public_path('clients/images/avatar/' . $user->avatar))) {
            unlink(public_path('clients/images/avatar/' . $user->avatar));
        }

        // Lưu ảnh mới
        $file = $request->file('avatar');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // tên file gốc (không kèm .jpg)
        $extension = $file->getClientOriginalExtension(); // phần mở rộng (jpg, png,...)

        // Tạo tên mới: tên-gốc + thời gian + random string
        $fileName = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;

        $file->move(public_path('clients/images/avatar'), $fileName);

        // Cập nhật DB
        $user->avatar = $fileName;
        $user->save();

        return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
    }

    public function updateDetail(Request $request, $id)
    {

        $request->validate([
            'userName'    => 'required|string|max:255',
            'address'     => 'nullable|string|max:255',
            'email'       => 'required|email|unique:tbl_users,email,' . $id . ',userId',
            'phoneNumber' => 'nullable|string|max:20',
        ]);


        $user = User::findOrFail($id);

        $user->userName    = $request->userName;
        $user->address     = $request->address;
        $user->email       = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function changePassword(Request $request)
{
    $request->validate([
        'current_password'      => 'required',
        'new_password'          => 'required|string|min:6|confirmed', 
        // "confirmed" yêu cầu có field new_password_confirmation
    ]);

    $user = Auth::user();

    // Kiểm tra mật khẩu cũ
    if (!Hash::check($request->current_password, $user->passWord)) {
        return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
    }

    // Cập nhật mật khẩu mới
    $user->passWord = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Đổi mật khẩu thành công!');
}
}
