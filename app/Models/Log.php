<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'steps',
        'workout',
        'weight',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
