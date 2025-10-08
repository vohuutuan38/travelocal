<?php

namespace App\Http\Controllers\admins;

use App\Models\ActivityIcon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListActivityIcon extends Controller
{
   public function index()
    {
        $icons = ActivityIcon::latest()->paginate(10);
        return view('admins.activity-icon.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.activity-icon.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);
        ActivityIcon::create($request->all());
        return redirect()->route('admin.listIcon')->with('success', 'Thêm icon hoạt động thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityIcon $icon)
    {
        return view('admins.activity-icon.edit', compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityIcon $icon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);
        $icon->update($request->all());
        return redirect()->route('admin.listIcon')->with('success', 'Cập nhật icon hoạt động thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityIcon $icon)
    {
        $icon->delete();
        return redirect()->route('admin.listIcon')->with('success', 'Xóa icon hoạt động thành công!');
    }

    /**
     * Hiển thị danh sách các icon đã bị xóa mềm (thùng rác).
     */
    public function trash()
    {
        $trashedIcons = ActivityIcon::onlyTrashed()->paginate(10);
        return view('admins.activity-icon.trash', compact('trashedIcons'));
    }

    /**
     * Khôi phục một icon đã bị xóa mềm.
     * (ĐÃ CẬP NHẬT)
     */
    public function restore(ActivityIcon $icon)
    {
        
        $icon->restore();
        return redirect()->route('admin.trashIcon')->with('success', 'Khôi phục icon thành công!');
    }

    /**
     * Xóa vĩnh viễn một icon khỏi database.
     * (ĐÃ CẬP NHẬT)
     */
    public function forceDelete(ActivityIcon $icon)
    {
        $icon->forceDelete();
        return redirect()->route('admin.trashIcon')->with('success', 'Đã xóa vĩnh viễn icon!');
    }
}
