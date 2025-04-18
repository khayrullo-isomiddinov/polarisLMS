<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Task extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'points'];
    protected $casts = [
        'deadline' => 'datetime',
    ];
    
        public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }


}
