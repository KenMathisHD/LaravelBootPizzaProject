<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts() {
        return $this->belongsToMany('\App\Models\Post', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
        // this is for a many to many relationship - 1 post can have many tags, and 1 tag can go to many posts
        // We need to make sure to chain withTimestamps if we want to make sure that the timestamps in our pivot table also get filled out when a new relationship entry is created
    }
}
