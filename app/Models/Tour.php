<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tbl_tour';
    protected $primaryKey = 'tourId';
    protected $fillable = [
        'title',
        'description',
        'images',
        'quantity',
        'priceAdult',
        'priceChild',
        'destination',
        'availability',
        'itinerary',
        'startDate',
        'endDate',
        'review',
    ];
    // Quan hệ 1 tour có nhiều ảnh
    public function images()
    {
        return $this->hasMany(Image::class, 'tourId', 'tourId');
    }

    // Quan hệ 1 tour có nhiều timeline
    public function timelines()
    {
        return $this->hasMany(Timeline::class, 'tourId', 'tourId');
    }
    // Lấy ảnh đại diện (thumbnail) của tour
    public function thumbnail()
    {
        return $this->hasOne(Image::class, 'tourId', 'tourId')->orderBy('imageId', 'asc');
    }
    // 1 Tour có nhiều Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tourId', 'tourId');
    }
}
