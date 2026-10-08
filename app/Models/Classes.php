<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Classes extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        "class",
        "section"
    ];
    
    public function examinations(): BelongsToMany
    {
        return $this->belongsToMany(Examination::class, 'exam_class_assignment', 'class_id', 'examination_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

}
