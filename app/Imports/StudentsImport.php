<?php

// namespace App\Imports;

// use App\Models\Student;
// use App\Models\ClassModel; // Replace with your actual class model
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class StudentImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         // Find class_id based on the class name in CSV
//         $class = ClassModel::where('name', $row['class'])->first();

//         return new Student([
//             'name' => $row['name'],
//             'email' => $row['email'],
//             'class_id' => $class ? $class->class : null, // Assign foreign key class_id
//         ]);
//     }
// }
namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    public function model(array $row)
    {
        return new Student([
            'name' => $row[0],
            'email' => $row[1],
            'class_id' => $row[2],
            'section_id' => $row[3],
        ]);
    }
}

