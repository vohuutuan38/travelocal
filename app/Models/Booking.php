<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
       use HasFactory;

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
    ];
}
