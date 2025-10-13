<?php

namespace App\Http\Controllers\admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        return view('admins.dashboard');
    }

    public function login(Request $request)
    {
        // dd('hahaaaa');
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Sai thông tin đăng nhập']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admins.login-admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
