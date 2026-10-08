<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

    protected $primaryKey = 'chapter_id';
    // public $incrementing = true;
    // protected $keyType = 'int';

    protected $fillable = [
        "chapter_name",
        "subject_id",
        "class_id",
        "start_date",
        "end_date",
        "status",
        "actual_start_date",
        "actual_end_date"
    ];

    // Define relationships
    // public function subject() {
    //     return $this->belongsTo(Subjects::class, 'subject_id');
    // }

    // public function class() {
    //     return $this->belongsTo(Classes::class, 'class_id');
    // }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'chapter_sections')
                    ->withPivot('actual_start_date', 'actual_end_date')
                    ->withTimestamps();
    }

}

