<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $table = 'tbl_cities';
    protected $primaryKey = 'cityId';

    protected $fillable = [
        'name',
        'slug',
        'domain',
        'description',
        'thumbnail',
        'is_active'
    ];

    // Relationship với Tour
    public function tours()
    {
        return $this->hasMany(Tour::class, 'cityId', 'cityId');
    }
    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Tour::class, 'cityId', 'tourId', 'cityId', 'tourId');
    }

    // Scope để lấy cities đang active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope theo vùng miền
    public function scopeByDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    // Lấy tên vùng miền
    public function getDomainNameAttribute()
    {
        $domains = [
            'b' => 'Miền Bắc',
            't' => 'Miền Trung',
            'n' => 'Miền Nam'
        ];
        return $domains[$this->domain] ?? '';
    }

    // Lấy tất cả ảnh từ các tour thuộc thành phố này
    public function getAllTourImages()
    {
        return Image::whereIn('tourId', $this->tours()->pluck('tourId'))->get();
    }
}
