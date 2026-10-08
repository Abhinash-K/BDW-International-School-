<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;

class SubjectsImport implements ToModel
{
    public function model(array $row)
    {
        return new Subject([
            'subject' => $row[0], // Assuming column 0 contains subject names
        ]);
    }
}
