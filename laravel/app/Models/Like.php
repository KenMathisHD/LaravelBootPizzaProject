<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public function post() {
        return $this->belongsTo('\App\Models\Post', 'post_id');
        // this points to our post model we have in our models folder here
        // Here' we're also adjusting the name of the database field to post_id. It's not strictly necessary, but I want to show this so I know how to do it in the future. Also, I think it helps keep better track of what things are associated with what bits of code
    }
}
