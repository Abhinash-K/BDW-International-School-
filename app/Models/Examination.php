<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['exam_type', 'class_id', 'exam_date_from', 'exam_date_to', 'calendar_id', 'event_id', 'weightage'];

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class,'exam_class_assignment', 'examination_id', 'class_id');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'exam_subject', 'exam_id', 'subject_id');
    }
}
