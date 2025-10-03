<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourIncludeExclude extends Model
{
      use HasFactory;
    protected $table = 'tbl_tour_include_exclude';
    protected $fillable = ['tourId', 'type', 'content'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
}
