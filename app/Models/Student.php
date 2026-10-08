<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // Ensure this matches your table name

    protected $primaryKey = 'student_id'; // If your primary key is 'student_id' instead of 'id'

    protected $fillable = [
        'class_id','name', 'roll_number', 'dob', 'father_name', 
        'father_contact', 'mother_name', 'mother_contact', 'guardian_name', 
        'guardian_contact', 'address'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject','student_id', 'subject_id');
    }

}
