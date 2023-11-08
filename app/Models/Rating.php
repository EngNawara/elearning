<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // use HasFactory;
    protected $guarded =[];
    protected $casts = ['date'=>'datetime'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function course():BelongsTo
    {
    return $this->belongsTo(Course::class , 'course_id','id');
    }
}
