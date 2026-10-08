<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    
    protected $table = 'sections';
    protected $primaryKey = 'section_id';
    protected $fillable = ['class_id', 'section_name'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_sections')
                    ->withPivot('actual_start_date', 'actual_end_date')
                    ->withTimestamps();
    }

}
