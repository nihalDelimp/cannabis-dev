<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJoinList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "event_join_list";
    protected $casts = [
        // 'start_time' => 'array',
        // 'end_time' => 'array',
        
        
    ];
    
    public function users()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
