<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'title',
        'slug',
        'status',
        'post_type'
    ];

    public function posts(){
      return $this->belongsToMany('App\Models\Post','posts_tags','tag_id','post_id')
      ->select(['posts.id', 'posts.title', 'posts.sub_title', 'posts.slug', 'posts.content', 'posts.image', 'posts.created_at']);
    }
}
