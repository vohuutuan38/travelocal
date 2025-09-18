<?php

namespace App\Http\Controllers\clients;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function login(Request $request)
    {
        // tìm user theo email
        $user = User::where('email', $request->email_login)->first();

        if (!$user) {
            return back()->withErrors(['email_login' => 'Email không tồn tại']);
        }

        // check password
        if (!Hash::check($request->password_login, $user->passWord)) {
            return back()->withErrors(['password_login' => 'Mật khẩu không chính xác']);
        }

        // đăng nhập user thủ công
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
    }


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

        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
            //   Mail::to($user->email)->queue(new WelcomeEmail($user));
            \Log::info('Welcome email sent to: ' . $user->email);
        } catch (\Exception $e) {
            \Log::error('Email error: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
