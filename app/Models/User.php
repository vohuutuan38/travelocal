<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'tbl_users';
    protected $primaryKey = 'userId';
    public $incrementing = true; // hoặc false nếu không tự tăng
    protected $keyType = 'int'; // hoặc 'string' nếu là varchar

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'userName',
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
        'updated_at	',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'passWord',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'passWord' => 'hashed',
        ];
    }
    public function getAuthPassword()
{
    return $this->passWord;
}
}
