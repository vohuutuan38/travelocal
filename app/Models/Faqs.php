<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqs extends Model
{
      use HasFactory,SoftDeletes;

    protected $table = 'tbl_faqs';
     protected $primaryKey = 'id';
    protected $fillable =
    [
        'id',
         'question',
         'answer',
         'created_at',
         'updated_at',
         'deleted_at',
        
    ];
    public $timestamps = true;
    
}
