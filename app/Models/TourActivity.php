<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourActivity extends Model
{
    use HasFactory;
    protected $table = 'tbl_tour_activity';
    protected $fillable = ['tourId', 'name', 'icon'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
}
