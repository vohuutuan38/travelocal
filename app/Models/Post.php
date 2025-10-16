<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong cơ sở dữ liệu.
     *
     * @var string
     */
    protected $table = 'tbl_posts';

    /**
     * Khóa chính của bảng.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'adminId',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'status',
        'published_at',
    ];

    /**
     * Các thuộc tính nên được chuyển đổi kiểu dữ liệu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Lấy danh mục mà bài viết thuộc về.
     */
    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_id', 'id');
    }

    /**
     * Lấy thông tin tác giả (admin) của bài viết.
     *
     * Lưu ý: Bạn cần tạo model 'Admin' tương ứng với bảng 'tbl_admin'.
     */
    public function author()
    {
        // Giả sử model của bạn tên là Admin và khóa chính là adminId
        return $this->belongsTo(Admin::class, 'adminId', 'adminId');
    }
}
