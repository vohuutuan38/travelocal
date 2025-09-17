<?php

namespace App\Http\Controllers\clients;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Đăng nhập";
        return view('clients.login', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function register(Request $request)
    {
        $request->validate([
            'email'       => 'required|email|unique:tbl_users,email',
        ], [
            'email.unique' => 'Email đã tồn tại trong hệ thống',
        ]);
        // dd($request->all());
        $user = User::create([
            'userName'   => $request->user_name,
            'email'      => $request->email,
            'passWord'   => Hash::make($request->password),
            'isActive'   => 1,
            'ipAddress'  => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Đăng ký thành công!');
       
    }

    public function checkEmail(Request $request)
{
    $exists = User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
}

}
