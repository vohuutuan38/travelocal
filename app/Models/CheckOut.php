<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckOut extends Model
{
         use HasFactory;

    protected $table = 'tbl_checkout';
    protected $fillable =
    [
        'checkoutId',
         'bookingId',
         'paymentMethod',
         'paymentDate',
         'amount',
         'paymentStatus',
         'transactionId',
        
    ];
}
