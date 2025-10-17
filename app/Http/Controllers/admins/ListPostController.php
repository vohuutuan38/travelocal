<?php

namespace App\Http\Controllers\admins;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListPostController extends Controller
{
  public function index(Request $request)
    {
        $query = Post::with('category')->latest();
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $posts = $query->paginate(10);
        return view('admins.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = CategoryPost::orderBy('name')->get();
        return view('admins.post.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tbl_posts,title',
            'category_id' => 'required|exists:tbl_post_categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
             $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . '.' . $extension;
             $file->move(public_path('clients/images/blog/'), $filename);
            $validated['thumbnail'] = $filename;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['adminId'] = Auth::guard('admin')->id();
        $validated['published_at'] = ($validated['status'] == 'published') ? now() : null;

        Post::create($validated);

        return redirect()->route('admin.listPost')->with('success', 'Tạo bài viết thành công.');
    }

    public function edit(Post $post)
    {
        $categories = CategoryPost::orderBy('name')->get();
        return view('admins.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tbl_posts,title,' . $post->id,
            'category_id' => 'required|exists:tbl_post_categories,id',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu có
            if ($post->thumbnail) {
            
                  @unlink(public_path('clients/images/blog/'.$post->thumbnail));
            }
            $file = $request->file('thumbnail');
             $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . '.' . $extension;
             $file->move(public_path('clients/images/blog/'), $filename);
            $validated['thumbnail'] = $filename;
        }
        
        $validated['slug'] = Str::slug($validated['title']);
        $validated['published_at'] = ($validated['status'] == 'published' && !$post->published_at) ? now() : $post->published_at;

        $post->update($validated);

        return redirect()->route('admin.listPost')->with('success', 'Cập nhật bài viết thành công.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.listPost')->with('success', 'Đã chuyển bài viết vào thùng rác.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admins.post.trash', compact('posts'));
    }
    
    public function restore(Post $post)
    {
        $post->restore();
        return redirect()->route('admin.trashPost')->with('success', 'Khôi phục bài viết thành công.');
    }

    public function forceDelete(Post $post)
    {
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->forceDelete();
        return redirect()->route('admin.trashPost')->with('success', 'Đã xóa vĩnh viễn bài viết.');
    }
}
