<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckOut extends Model
{
         use HasFactory;

    protected $table = 'tbl_checkout';
     protected $primaryKey = 'checkoutId';
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

      // Checkout thuộc về 1 Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingId', 'bookingId');
    }
}
