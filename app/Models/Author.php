<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function posts()
    {
        return $this->hasMany(NewsPost::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
