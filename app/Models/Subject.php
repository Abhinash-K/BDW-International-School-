<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject','student_id', 'subject_id');
    }
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_subject', 'id', 'class_id');
    }
    public function examinations() 
    {
        return $this->belongsToMany(Examination::class,'exam_subject','subject_id','exam_id');
    }
}
