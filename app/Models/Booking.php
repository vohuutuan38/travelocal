<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_booking';
    protected $primaryKey = 'bookingId';
    protected $fillable =
    [
        'bookingId',
        'tourId',
        'userId',
        'bookingDate',
        'numAdults',
        'numChildren',
        'totalPrice',
        'fullname',
        'email',
        'phone',
        'address',
        'bookingStatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected static function booted(): void
    {
        static::saved(function ($booking) {
            // Xóa cache khi một booking được tạo mới hoặc cập nhật
            Cache::forget('dashboard_booking_status');
        });

        static::deleted(function ($booking) {
            // Xóa cache khi một booking bị xóa
            Cache::forget('dashboard_booking_status');
        });
    }
    // Booking thuộc về 1 User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    // Booking thuộc về 1 Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }

    // Booking có 1 Checkout
    public function checkout()
    {
        return $this->hasOne(CheckOut::class, 'bookingId', 'bookingId');
    }
}
