<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeLine extends Model
{
    use HasFactory;
     protected $table = 'tbl_timeline';
    protected $fillable = [
        'tourId',
         'title',
         'description'
        ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
}
