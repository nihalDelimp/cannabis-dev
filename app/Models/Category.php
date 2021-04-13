<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'status',
        'post_type'
    ];

    public function post(){
      return $this->hasMany('App\Models\Post');
    }
}
