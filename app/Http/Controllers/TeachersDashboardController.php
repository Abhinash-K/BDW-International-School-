<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherAssignment;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Chapter;

class TeachersDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $assignments = TeacherAssignment::where('teacher_id', $teacher->id)->get();

        $classIds = $assignments->pluck('class_id');
        $sectionIds = $assignments->pluck('section_id');
        $subjectIds = $assignments->pluck('subject_id');

        $classes = ClassModel::whereIn('id', $classIds)->get();
        $sections = Section::whereIn('id', $sectionIds)->get();
        $subjects = Subject::whereIn('id', $subjectIds)->get();
        $chapters = Chapter::whereIn('class_id', $classIds)->get();

        return view('teachers.dashboard', compact('classes', 'sections', 'subjects', 'chapters'));
    }
}
