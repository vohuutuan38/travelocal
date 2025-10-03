<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourLocationMap extends Model
{
      use HasFactory;
    protected $table = 'tbl_tour_location_map';
    protected $fillable = ['tourId', 'map_link'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
}
