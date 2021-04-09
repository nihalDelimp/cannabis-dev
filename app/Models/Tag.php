<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'status',
        'post_type'
    ];

    public function posts(){
      return $this->belongsToMany('App\Models\Post','posts_tags','tag_id','post_id');
    }
}
