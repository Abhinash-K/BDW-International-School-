<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Subject;
use App\Models\Classes;

class StudentController extends Controller
{   
    public function show($id)
    {
        $student = Student::with('class', 'subjects')->findOrFail($id);
        return view('students.show', compact('student'));
    }
    // Display all students
    public function index()
    {
        $students = Student::all();
        //dd($students);
        return view('students.index', compact('students'));
    }

    // Show form to add a student
    public function create()
    {
        $classes = Classes::all();
        return view('students.create', compact('classes'));
    }

    // Store new student
    public function store(Request $request)
    {   
        //$dd->request();
        $request->validate([
            //'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'roll_number' => 'required|unique:students,roll_number',
            'dob' => 'required|date',
            'father_name' => 'required|string|max:255',
            'father_contact' => 'required|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_contact' => 'required|string|max:15',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:15',
            'address' => 'required|string|max:500',
        ]);

        Student::create($request->except('user_id'));

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    // Show form to edit student
    public function edit(Student $student)
    {
        //$classes = Classes::all();
        return view('students.edit', compact('student', 'classes'));
    }

    // Update student data
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'roll_number' => 'required|unique:students,roll_number,' . $student->id,
            'dob' => 'required|date|before:today',
            'father_name' => 'required|string|max:255',
            'father_contact' => 'required|string|max:10',
            'mother_name' => 'required|string|max:255',
            'mother_contact' => 'required|string|max:10',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:10',
            'address' => 'required|string|max:500',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
    public function showAssignSubjects($id)
    {
        $student = Student::findOrFail($id);
        $subjects = Subject::all();
        return view('students.assign_subject', compact('student', 'subjects'));
    }
    public function assignSubjects(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('students.showAssignSubjects', $id)->with('success', 'Subjects assigned successfully!');
    }
    public function showUploadForm()
    {
        return view('students.upload');
    }
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        // Read file
        $file = fopen($request->file('csv_file'), 'r');

        // Skip the first row (headers)
        fgetcsv($file);

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // Ensure class_id exists
            $class = ClassModel::where('class', $data[1])->first();
            if (!$class) continue; // Skip if class doesn't exist

            // Create Student
            Student::create([
                'name' => $data[0], // Student Name
                'class_id' => $class->id,
                'roll_number' => $data[2],
                'dob' => $data[3],
                'father_name' => $data[4],
                'father_contact' => $data[5],
                'mother_name' => $data[6],
                'mother_contact' => $data[7],
                'guardian_name' => $data[8] ?? null,
                'guardian_contact' => $data[9] ?? null,
                'address' => $data[10]
            ]);
        }

        fclose($file);

        return redirect()->route('students.upload')->with('success', 'Students imported successfully!');
    }
    public function uploadStudents(Request $request)
    {   
        return response()->json(['message' => 'Route is working'], 200);
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,csv'
        // ]);

        // try {
        //     Excel::import(new StudentsImport, $request->file('file'));

        //     return back()->with('success', 'Students uploaded successfully!');
        // } catch (\Exception $e) {
        //     return back()->with('error', 'Error importing students: ' . $e->getMessage());
        // }
    }

}
