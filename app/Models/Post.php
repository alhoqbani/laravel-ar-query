<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function city()
    {
        return $this->author->city();
    }
}
