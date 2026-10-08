<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherAssignment;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;

class TeacherAssignmentController extends Controller
{
    /**
     * Show the teacher assignment form.
     */
    public function create()
    {   
        
        $teachers = User::where('role', 2)->get();
        $classes = ClassModel::all();
        $sections = Section::all();
        $subjects = Subject::all();
        
        //dd($sections);
        //dd(compact('teachers', 'classes', 'sections', 'subjects'));

        return view('teacher_assignments.create', compact('teachers', 'classes', 'sections', 'subjects'));
    }

    /**
     * Store the teacher assignment.
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        //dd(\App\Models\Section::where('class_id', $request->class_id)->get());
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'class_id'   => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,section_id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Create teacher assignment
        TeacherAssignment::create([
            'teacher_id' => $request->teacher_id,
            'class_id'   => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            // 'teacher_id' => 1, // Replace with existing teacher ID
            // 'class_id'   => 1, // Replace with an existing class ID
            // 'section_id' => 1, // Replace with an existing section ID
            // 'subject_id' => 1, // Replace with an existing subject ID
        ]);

        return redirect()->back()->with('success', 'Teacher assigned successfully!');
    }

    /**
     * Show the list of teacher assignments.
     */
    public function index()
    {
        $assignments = TeacherAssignment::with(['teacher', 'class', 'section', 'subject'])->get();
        //dd($assignments);
        return view('teacher_assignments.index', compact('assignments'));
    }
}
