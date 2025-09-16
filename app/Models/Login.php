<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Login extends Model
{
    //
     use HasFactory;
    protected $table = 'tbl_users';
    protected $fillable =
    [
        'userName',
         'passWord',
         'email',
         'phoneNumber',
         'address',
         'uploadDate',
         'isActive',
         'status',
    ];
}
