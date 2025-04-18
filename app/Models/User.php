<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

        // A teacher's created subjects
    public function taughtSubjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function enrolledSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Subjects a student is enrolled in
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    // Student's submitted solutions
    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
