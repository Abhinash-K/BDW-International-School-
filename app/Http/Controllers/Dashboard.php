<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LessonPlan;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subjects;
use Illuminate\Support\Facades\DB;



/**
 * Dashboard Class
 */
class Dashboard extends Controller
{

    /**
     * Render Dashboard
     *
     * @return void
     */
    public function index()
    {
        return view(
            "dashboard.index",
            [
                'users' => User::count(),
                'coordinators' => User::where('role', 1)->count(),
                'teachers' => User::where('role', 2)->count(),
                'lessonPlans' => $this->lessonPlansbyClass(),
                'teacherslessonPlans' => $this->lessonPlansbyTeachers(),
                'subjectlessonPlans' => $this->lessonPlansbySubjects(),
                'chapterlessonPlans' => $this->lessonPlansbyChapters(),
            ]
        );
    }

    function lessonPlansbyClass()
    {
        $lessonPlansCount = DB::table('lessonplans')
        ->join('classes', 'lessonplans.class_id', '=', 'classes.id')
        ->selectRaw('lessonplans.class_id, classes.class as class, COUNT(*) as total')
        ->groupBy('lessonplans.class_id', 'classes.class')
        ->get();
        return $lessonPlansCount;
    }

    function lessonPlansbyTeachers()
    {
        $lessonPlansCount = DB::table('lessonplans')
        ->join('users', 'lessonplans.teacher_id', '=', 'users.id')
        ->selectRaw('lessonplans.teacher_id, users.email as teacher, COUNT(*) as total')
        ->groupBy('lessonplans.teacher_id', 'users.email')
        ->get();
        return $lessonPlansCount;
    }

    function lessonPlansbySubjects()
    {
        $lessonPlansCount = DB::table('lessonplans')
        ->join('subjects', 'lessonplans.subject_id', '=', 'subjects.id')
        ->selectRaw('lessonplans.subject_id, subjects.subject as subject, COUNT(*) as total')
        ->groupBy('lessonplans.subject_id', 'subjects.subject')
        ->get();
        return $lessonPlansCount;
    }
    function lessonPlansbyChapters()
    {
        $lessonPlansCount = DB::table('lessonplans')
        ->join('subjects', 'lessonplans.subject_id', '=', 'subjects.id')
        ->selectRaw('lessonplans.subject_id, subjects.subject as subject, COUNT(*) as total')
        ->groupBy('lessonplans.subject_id', 'subjects.subject')
        ->get();
        return $lessonPlansCount;
    }
}
