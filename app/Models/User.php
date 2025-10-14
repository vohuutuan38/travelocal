<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users';     // ✅ Bảng trong DB
    protected $primaryKey = 'userId';   // ✅ Khóa chính
    public $incrementing = true;        // Khóa chính auto increment
    protected $keyType = 'int';         // Kiểu dữ liệu của khóa chính

    protected $fillable = [
        'userName',
        'fullname',
        'passWord',
        'email',
        'avatar',
        'phoneNumber',
        'address',
        'ipAddress',
        'google_id',
        'isActive',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'passWord',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'passWord' => 'hashed',
        ];
    }
public function reviews()
{
    return $this->hasMany(Review::class, 'userId', 'userId');
}
    // ✅ Quan trọng: để Laravel Auth lấy đúng cột mật khẩu
    public function getAuthPassword()
    {
        return $this->passWord;
    }
      public function bookings()
    {
        return $this->hasMany(Booking::class, 'userId', 'userId');
    }
}

