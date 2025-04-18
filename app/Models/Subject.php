<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model {
   

    use SoftDeletes;
    protected $fillable = ['name', 'code', 'credits', 'description', 'user_id'];
        //
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'subject_user');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
