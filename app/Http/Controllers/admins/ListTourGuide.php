<?php

namespace App\Http\Controllers\admins;

use App\Models\Tour;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guide;

class ListTourGuide extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::all();
        return view('admins.tour-guide.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.tour-guide.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'bio' => 'required|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . '.' . $extension;
                $file->move(public_path('clients/images/guide/'), $filename);
                $data['avatar'] = $filename;
            }

            Guide::create($data);
            return redirect()->route('admin.listGuide')->with('success', 'Thêm hướng dẫn viên thành công!');
        }
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
    public function edit($id)
    {
        $guide = Guide::findOrFail($id);
        return view('admins.tour-guide.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        $guide = Guide::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $originalName . '.' . $extension;
            $file->move(public_path('clients/images/guide/'), $filename);
            $data['avatar'] = $filename;

            // Xóa ảnh cũ nếu tồn tại
            if (!empty($guide->avatar) && file_exists(public_path('clients/images/guide/' . $guide->avatar))) {
                @unlink(public_path('clients/images/guide/' . $guide->avatar));
            }
        }

        $guide->update($data);
        return redirect()->route('admin.listGuide')->with('success', 'Cập nhật hướng dẫn viên thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
