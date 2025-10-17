<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
     // --- Lấy dữ liệu cho danh sách bài viết chính (có filter) ---
        $postsQuery = Post::with(['category', 'author'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at');
            
        // Xử lý tìm kiếm
        if ($request->filled('search')) {
            $postsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $postsQuery->paginate(5)->withQueryString();

        // --- Lấy dữ liệu cho SIDEBAR ---

        // 1. Lấy danh sách danh mục có bài viết
        $categories = CategoryPost::withCount('posts') // Đếm số bài viết trong mỗi danh mục
            ->having('posts_count', '>', 0) // Chỉ lấy danh mục có bài viết
            ->orderBy('name', 'asc')
            ->get();

        // 2. Lấy 3 bài viết gần đây nhất
        $recentPosts = Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();
            
        // 3. Lấy ảnh cho Gallery (lấy thumbnail từ 9 bài viết mới nhất có ảnh)
        $galleryImages = Post::where('status', 'published')
            ->whereNotNull('thumbnail')
            ->latest()
            ->take(9)
            ->pluck('thumbnail');

        // Trả về view với tất cả dữ liệu
        return view('clients.blog', compact('posts', 'categories', 'recentPosts', 'galleryImages'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function category(Request $request, CategoryPost $category)
    {
        // --- Lấy dữ liệu cho danh sách bài viết chính (đã lọc theo category) ---
        $postsQuery = $category->posts() // Bắt đầu từ relationship của category
            ->with(['category', 'author'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at');

        // Vẫn cho phép tìm kiếm trong trang category
        if ($request->filled('search')) {
            $postsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $postsQuery->paginate(5)->withQueryString();

        // --- Lấy dữ liệu cho SIDEBAR (tương tự như hàm index) ---
        $categories = CategoryPost::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('name', 'asc')
            ->get();

        $recentPosts = Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();
            
        $galleryImages = Post::where('status', 'published')
            ->whereNotNull('thumbnail')
            ->latest()
            ->take(9)
            ->pluck('thumbnail');

        // Trả về cùng một view 'clients.blog' nhưng với dữ liệu đã được lọc
        return view('clients.blog', compact('posts', 'category', 'categories', 'recentPosts', 'galleryImages'));
    }
    public function show(Post $post)
    {
        // Lấy dữ liệu cho sidebar
        $categories = CategoryPost::withCount('posts')->having('posts_count', '>', 0)->get();
        $recentPosts = Post::where('status', 'published')->where('published_at', '<=', now())->where('id', '!=', $post->id)->latest('published_at')->take(3)->get();
         $galleryImages = Post::where('status', 'published')
            ->whereNotNull('thumbnail')
            ->latest()
            ->take(9)->pluck('thumbnail');
        // Kiểm tra bài viết có được phép xem không
        if ($post->status !== 'published' || $post->published_at > now()) {
            abort(404);
        }
        
        return view('clients.blog-detail', compact('post', 'categories', 'recentPosts','galleryImages'));
    }
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
    //   public function show()
    // {
    //     return view('clients.blog-detail');
    // }
   
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
