<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Examination;
use App\Models\ClassModel;

class ExamResultController extends Controller
{
    // Show the result entry page
    public function create()
    {
        $exams = Examination::all();
        $classes = ClassModel::all(); // Ensure you have the correct model name
        $students = Student::with('subjects')->get(); // Fetch students with assigned subjects

        return view('exam_results.create', compact('exams', 'classes', 'students'));
    }

    public function index()
    {
        $exams = Examination::all();
        $classes = ClassModel::all();

        return view('exam_results.index', compact('exams', 'classes'));
    }

    // Fetch students and their subjects as JSON
    // public function fetchStudents(Request $request)
    // {
    //     $request->validate([
    //         'class_id' => 'required|exists:classes,id',
    //         'exam_id' => 'required|exists:examinations,id',
    //     ]);

    //     // Fetch students of the selected class
    //     $students = Student::where('class_id', $request->class_id)->get();

    //     // Fetch subjects assigned to this class
    //     $subjects = Subject::where('class_id', $request->class_id)->get();

    //     $resultData = [];

    //     foreach ($students as $student) {
    //         foreach ($subjects as $subject) {
    //             $resultData[] = [
    //                 'student_id' => $student->student_id,
    //                 'student_name' => $student->user->name, // Assuming a relation exists
    //                 'subject_id' => $subject->id,
    //                 'subject_name' => $subject->subject,
    //                 'marks_obtained' => null, // To be entered
    //                 'total_marks' => 100, // Default value
    //             ];
    //         }
    //     }

    //     return response()->json($resultData);
    // }

    // 
    // working for one
    // 
    public function fetchStudentsSubjects(Request $request)
{
    $students = Student::where('class_id', $request->class_id)->get();

    $subjects = Subject::whereIn('id', function ($query) use ($request) {
        $query->select('subject_id')
            ->from('exam_subject')
            ->where('exam_id', $request->exam_id);
    })->get();

    if ($students->isEmpty() || $subjects->isEmpty()) {
        return response()->json(['error' => 'No students or subjects found.'], 404);
    }

    $data = [];
    foreach ($students as $student) {
        foreach ($subjects as $subject) {
            $data[] = [
                'student_id'   => $student->id,
                'student_name' => $student->father_name, // Ensure this field exists
                'subject_id'   => $subject->id,
                'subject_name' => $subject->subject,
                'total_marks'  => 100
            ];
        }
    }

    return response()->json($data, 200, [], JSON_PRETTY_PRINT); // Return JSON properly
}



    // public function fetchStudentsWithSubjects($exam_id, $class_id)
    // {
    //     $students = Student::where('class_id', $class_id)
    //         ->with('subjects') // Assuming you have a subjects() relationship in the Student model
    //         ->get();

    //     return view('exam_results.create', compact('students', 'exam_id', 'class_id'));
    // }
    public function fetchStudentsWithSubjects($exam_id, $class_id)
    {
        // Fetch students assigned to the selected class
        $students = Student::where('class_id', $class_id)
            ->with(['subjects' => function ($query) use ($exam_id) {
                $query->whereIn('id', function ($subQuery) use ($exam_id) {
                    $subQuery->select('subject_id')
                        ->from('exam_subject')
                        ->where('exam_id', $exam_id);
                });
            }])->get();

        return view('exam_results.create', compact('students', 'exam_id', 'class_id'));
    }




    // Store exam results
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'exam_id' => 'required|exists:examinations,id',
    //         'class_id' => 'required|exists:classes,id',
    //         'results' => 'required|array',
    //         'results.*.student_id' => 'required|exists:students,student_id',
    //         'results.*.subject_id' => 'required|exists:subjects,id',
    //         'results.*.marks_obtained' => 'required|numeric|min:0|max:100',
    //         'results.*.total_marks' => 'required|numeric|min:0|max:100',
    //     ]);

    //     foreach ($request->results as $result) {
    //         ExamResult::updateOrCreate(
    //             [
    //                 'student_id' => $result['student_id'],
    //                 'exam_id' => $request->exam_id,
    //                 'subject_id' => $result['subject_id'],
    //             ],
    //             [
    //                 'marks_obtained' => $result['marks_obtained'],
    //                 'total_marks' => $result['total_marks'],
    //                 'class_id' => $request->class_id,
    //                 'calendar_id' => now()->year, // Assuming current year as default
    //                 'year' => now()->year,
    //                 'grade' => $this->calculateGrade($result['marks_obtained']),
    //                 'remarks' => $result['marks_obtained'] >= 35 ? 'Pass' : 'Fail',
    //             ]
    //         );
    //     }

    //     return response()->json(['message' => 'Results saved successfully!']);
    // }
    public function store(Request $request)
    {
        $results = $request->input('results');

        foreach ($results as $result) {
            ExamResult::updateOrCreate(
                [
                    'exam_id'       => $request->exam_id,
                    'class_id'      => $request->class_id,
                    'student_id'    => $result['student_id'],
                    'subject_id'    => $result['subject_id']
                ],
                [
                    'marks_obtained' => $result['marks_obtained'],
                    'total_marks'    => $result['total_marks']
                ]
            );
        }

        return response()->json(['success' => 'Results saved successfully!']);
    }

    // Function to calculate grades based on marks
    private function calculateGrade($marks)
    {
        if ($marks >= 90) return 'A+';
        if ($marks >= 80) return 'A';
        if ($marks >= 70) return 'B+';
        if ($marks >= 60) return 'B';
        if ($marks >= 50) return 'C';
        if ($marks >= 35) return 'D';
        return 'F';
    }
}
