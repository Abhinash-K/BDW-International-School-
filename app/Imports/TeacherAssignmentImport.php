<?php

namespace App\Imports;

use App\Models\TeacherAssignment;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherAssignmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Find teacher, class, section, and subject by their names or IDs
        $teacher = User::where('email', $row['teacher_email'])->first();
        $class = ClassModel::where('class', $row['class'])->first();
        $section = Section::where('section_name', $row['section'])->first();
        $subject = Subject::where('subject', $row['subject'])->first();

        // Ensure all values exist before creating a record
        if ($teacher && $class && $section && $subject) {
            return new TeacherAssignment([
                'teacher_id' => $teacher->id,
                'class_id'   => $class->id,
                'section_id' => $section->section_id,
                'subject_id' => $subject->id,
            ]);
        }

        return null; // Skip invalid rows
    }
}
