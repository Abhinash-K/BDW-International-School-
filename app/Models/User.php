<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["admin", "coordinator", "teacher"][$value],
        );
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // Adjust this based on your implementation
    }

    public function isCoordinator()
    {
        return $this->role === 'coordinator'; // Adjust this based on your implementation
    }
    public function isTeacher()
    {
        return $this->role === 'teacher'; // Adjust this based on your implementation
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_teacher', 'teacher_id', 'class_id');
    }
    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class, 'teacher_id');
    }
    public function assignedClasses()
    {
        return $this->hasMany(TeacherClassAssignment::class, 'teacher_id');
    }


}
