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
        'time',
        'description',
        'quantity',
        'cityId',
        'priceAdult',
        'priceChild',
        'availability',
        'itinerary',
        'startDate',
        'endDate',
        'review',
    ];
    
    // Relationship với City
    public function city()
    {
        return $this->belongsTo(City::class, 'cityId', 'cityId');
    }
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
        return $this->hasOne(Image::class, 'tourId', 'tourId')->orderBy('imageId', 'asc')->withDefault(['imageURL' => 'default-tours.jpg', ]);
    }
    // 1 Tour có nhiều Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tourId', 'tourId');
    }
    public function includes()
    {
        return $this->hasMany(TourIncludeExclude::class, 'tourId', 'tourId')->where('type', 'include');
    }

    public function excludes()
    {
        return $this->hasMany(TourIncludeExclude::class, 'tourId', 'tourId')->where('type', 'exclude');
    }

    public function locationMap()
    {
        return $this->hasOne(TourLocationMap::class, 'tourId', 'tourId');
    }

    public function activities()
    {
        return $this->belongsToMany(ActivityIcon::class, 'tbl_tour_activity', 'tourId', 'activityIconId');
    }


    public function guides()
    {
        return $this->belongsToMany(Guide::class, 'tbl_tour_guide', 'tourId', 'guideId');
    }
    public function reviews()
{
    return $this->hasMany(Review::class, 'tourId', 'tourId');
}
}
