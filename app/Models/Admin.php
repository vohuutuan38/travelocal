<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 👈 thay vì Model
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_admin';     // ✅ Bảng trong DB
    protected $primaryKey = 'adminId';  // ✅ Khóa chính
    public $incrementing = true;        
    protected $keyType = 'int';         

    protected $fillable = [
        'userName',
        'passWord',
        'email',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'passWord',
        'remember_token',
    ];

    // 👇 Laravel mặc định dùng password field tên "password"
    public function getAuthPassword()
    {
        return $this->passWord;
    }
}
