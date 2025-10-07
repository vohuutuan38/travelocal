<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityIcon extends Model
{
     use HasFactory;

    protected $table = 'tbl_activity_icons';
    protected $primaryKey = 'activityIconId';
    protected $fillable = ['name', 'icon'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tbl_tour_activity', 'activityIconId', 'tourId');
    }
}
