<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MetaData;

class LessonPlan extends Model
{
    //
    protected $table = 'lessonplans';

    protected $fillable = [
        "title",
        "year_id",
        "class_id",
        "subject_id",
        "teacher_id",
        "start_date",
        "end_date",
        // "start_time",
        // "end_time",
        "tasks",
        "status",
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    // public function getMetaValueAttribute($value)
    // {
    //     return unserialize($value);
    // }

    // // Automatically serialize meta_value when saved
    // public function setMetaValueAttribute($value)
    // {
    //     $this->attributes['tasks'] = serialize($value);
    // }

}
