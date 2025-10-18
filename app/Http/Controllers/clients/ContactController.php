<?php

namespace App\Http\Controllers\clients;

use App\Models\Guide;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::all();
        return view('clients.contact', compact('guides'));
    }

    public function send(Request $request)
    {
        // 1. Validate dữ liệu
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // 2. Gửi email
        try {
            // Gửi đến địa chỉ email của bạn
            Mail::to('vohuutuan04@gmail.com')->send(new ContactFormMail($data));

            // 3. Trả về thông báo thành công
            return back()->with('success', 'Tin nhắn của bạn đã được gửi thành công! Chúng tôi sẽ liên hệ lại sớm nhất có thể.');
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có
            return back()->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại. Lỗi: ' . $e->getMessage());
        }
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
