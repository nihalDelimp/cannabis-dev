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
        'description',
        'post_type'
    ];

    public function post(){
        return $this->hasMany('App\Models\Post');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Post')->where(['post_type'=>'2','status'=>'1'])->orderBy('sort', 'ASC');
    }
}
