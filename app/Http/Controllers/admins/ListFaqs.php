<?php

namespace App\Http\Controllers\admins;

use App\Models\Faqs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListFaqs extends Controller
{
   public function index()
    {
        $faqs = Faqs::latest()->get();
        return view('admins.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admins.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        Faqs::create($request->only(['question', 'answer']));
        return redirect()->route('admin.listFaqs')->with('success', 'Đã thêm câu hỏi mới.');
    }

    public function edit(Faqs $faq)
    {
        return view('admins.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faqs $faq)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $faq->update($request->only(['question', 'answer']));
        return redirect()->route('admin.listFaqs')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Faqs $faq)
    {
        $faq->delete();
        return redirect()->route('admin.listFaqs')->with('success', 'Đã xóa mềm câu hỏi.');
    }

    public function trash()
    {
        $faqs = Faqs::onlyTrashed()->get();
        return view('admins.faqs.trash', compact('faqs'));
    }

    public function restore($id)
    {
        Faqs::withTrashed()->find($id)->restore();
        return redirect()->route('admin.trashFaqs')->with('success', 'Đã khôi phục câu hỏi.');
    }

    public function forceDelete($id)
    {
        Faqs::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.trashFaqs')->with('success', 'Đã xóa vĩnh viễn.');
    }
}
