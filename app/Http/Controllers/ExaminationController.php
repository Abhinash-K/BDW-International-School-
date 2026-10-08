<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Event;
use App\Models\ClassModel;
use App\Models\Calendar;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    // Show form to add an exam
    public function create()
    {
        $classes = ClassModel::all();
        $calendars = Calendar::all();
        $events = Event::all();
        return view('examinations.create', compact('classes', 'calendars','events'));
    }

    // Store a new exam
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'exam_type' => 'required|string',
            'class_ids' => 'required|array',
            'exam_date_from' => 'required|date',
            'exam_date_to' => 'required|date|after_or_equal:exam_date_from',
            'calendar_id' => 'nullable|exists:calendars,id',
            'event_id' => 'nullable|exists:events,id', // Fixed event validation
            'weightage' => 'nullable|integer|min:0|max:100',
            'class_ids.*' => 'exists:classes,id',
        ]);

        $exam = Examination::create([
            'exam_type' => $request->exam_type,
            'exam_date_from' => $request->exam_date_from,
            'exam_date_to' => $request->exam_date_to,
            'calendar_id' => $request->calendar_id,
            'event_id' => $request->event_id,
            'weightage' => $request->weightage,
        ]);

        // Attach multiple classes
        $exam->classes()->attach($request->class_ids);

        return redirect()->route('examinations.index')->with('success', 'Examination created successfully!');
    }


    // Show all exams
    public function index()
    {   
        $examinations = Examination::with('classes', 'calendar', 'event')->get();
        return view('examinations.index', compact('examinations'));
    }

    // Show exam schedule for a class
    public function schedule($class_id)
    {
        $class = ClassModel::findOrFail($class_id);
        $examinations = Examination::whereHas('classes', function ($query) use ($class_id) {
            $query->where('classes.id', $class_id);
        })->get();

        return view('examinations.schedule', compact('class', 'examinations'));
    }

    public function selectExamsPage()
    {
        $classes = ClassModel::all();
        return view('examinations.select_classes', compact('classes'));
    }

    public function edit($id)
    {
        $exam = Examination::findOrFail($id);
        $classes = ClassModel::all();
        $calendars = Calendar::all();
        $events = Event::all();
        return view('examinations.edit', compact('exam', 'classes', 'calendars', 'events'));
    }
    public function assignSubjects()
    {
        $exam = Examination::find(2); // Change 2 to your actual exam ID

        if ($exam) {
            $subjectIds = [1, 2, 3]; // Replace with actual subject IDs
            $exam->subjects()->sync($subjectIds);
            return response()->json(['message' => 'Subjects assigned successfully!']);
        } else {
            return response()->json(['message' => 'Exam not found.'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_type' => 'required|string',
            'class_ids' => 'required|array',
            'exam_date_from' => 'required|date',
            'exam_date_to' => 'required|date|after_or_equal:exam_date_from',
            'calendar_id' => 'nullable|exists:calendars,id',
            'event_id' => 'nullable|exists:events,id',
            'weightage' => 'nullable|integer|min:0|max:100',
        ]);

        $exam = Examination::findOrFail($id);
        $exam->update([
            'exam_type' => $request->exam_type,
            'exam_date_from' => $request->exam_date_from,
            'exam_date_to' => $request->exam_date_to,
            'calendar_id' => $request->calendar_id,
            'event_id' => $request->event_id,
            'weightage' => $request->weightage,
        ]);

        $exam->classes()->sync($request->class_ids);

        return redirect()->route('examinations.index')->with('success', 'Examination updated successfully!');
    }

    public function destroy($id)
    {
        $exam = Examination::findOrFail($id);
        $exam->classes()->detach(); // Remove class associations
        $exam->delete();

        return redirect()->route('examinations.index')->with('success', 'Examination deleted successfully!');
    }

    public function deleteAll()
    {
        Examination::truncate(); // Deletes all records
        return redirect()->route('examinations.index')->with('success', 'All examinations deleted successfully!');
    }


}
