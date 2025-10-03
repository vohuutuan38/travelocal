<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guide extends Model
{
     use HasFactory;
    protected $table = 'tbl_guide';
    protected $primaryKey = 'guideId';
    protected $fillable = ['name', 'avatar', 'phone', 'bio'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tbl_tour_guide', 'guideId', 'tourId');
    }
}
