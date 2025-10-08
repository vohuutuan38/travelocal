<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityIcon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_activity_icons';
    protected $primaryKey = 'activityIconId';
    protected $fillable = ['name', 'icon'];
    protected $dates = ['deleted_at'];
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tbl_tour_activity', 'activityIconId', 'tourId');
    }
}
