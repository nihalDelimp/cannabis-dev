<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'user_id',
        'category_id',
        'tags',
        'content',
        'post_type',
        'status',
        'image',
        'slug',
        'image',
        'file_path',
        'video_thumb_image',
        'link_id'
    ];

    public function tags(){
      return $this->belongsToMany('App\Models\Tag','posts_tags','post_id','tag_id')->select(['tags.id', 'tags.title', 'tags.slug']);
    }

    public function category(){
      return $this->belongsTo('App\Models\Category','category_id')->select(['categories.id', 'categories.title', 'categories.slug']);
    }

    public function getImagePathAttribute()
    {
        return url('images/posts/video/listing/'.$this->image);
    }
}
