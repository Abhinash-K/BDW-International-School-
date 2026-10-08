<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // Ensure Laravel looks for the correct table

    protected $fillable = ['name'];

    public function examinations(): BelongsToMany
    {
        return $this->belongsToMany(Examination::class, 'class_exam', 'class_id', 'exam_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'class_teacher', 'class_id', 'teacher_id');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_subject', 'class_id', 'id');
    }


}
