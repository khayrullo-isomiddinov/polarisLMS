<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
    {
    protected $fillable = [
        'task_id',
        'content',
    ];
        
        //
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


}
