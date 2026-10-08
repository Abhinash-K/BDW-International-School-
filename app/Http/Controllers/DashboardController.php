<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonPlan;

class DashboardController extends Controller
{
    public function index()
    {
        $lessonPlans = LessonPlan::all(); // Fetch all lesson plans
        return view('dashboard', compact('lessonPlans')); // Pass data to view
    }
}
