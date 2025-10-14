<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
      use HasFactory,SoftDeletes;
     protected $table = 'tbl_reviews';
    protected $primaryKey = 'reviewid';

    protected $fillable = [
        'tourId',
         'userId',
         'service',
         'food',
         'price',
         'hotel',
         'average',
         'comment',
        ];
    protected $dates = ['deleted_at'];

 // Một review thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    // Một review thuộc về một Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
   
}
