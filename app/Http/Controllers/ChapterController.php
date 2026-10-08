<?php
namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Section;

class ChapterController extends Controller 
{
    public function index() {
        $chapters = Chapter::all();
        return view('chapters.index', compact('chapters'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $sections = Section::all();

        return view('chapters.create', compact('classes','sections'));
    }

    // public function store(Request $request) {
    //     $request->validate([
    //         'chapter_name' => 'required',
    //         'subject_id' => 'required',
    //         'class_id' => 'required',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //         'status' => 'required',
    //     ]);
    //     Chapter::create($request->all());
    //     return redirect()->route('chapters.index');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'section_id' => 'required|array',
            'actual_start_date' => 'required|array',
            'actual_end_date' => 'required|array',
        ]);

        $chapter = Chapter::create([
            'chapter_name' => $request->chapter_name,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        foreach ($request->section_id as $sectionId) {
            $chapter->sections()->attach($sectionId, [
                'actual_start_date' => $request->actual_start_date[$sectionId],
                'actual_end_date' => $request->actual_end_date[$sectionId],
            ]);
        }

        return redirect()->route('chapters.index')->with('success', 'Chapter added successfully.');
    }

    public function edit(Chapter $chapter) {
        return view('chapters.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter) {
        $request->validate([
            'chapter_name' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
        ]);
        $chapter->update($request->all());
        return redirect()->route('chapters.index');
    }

    public function destroy(Chapter $chapter) {
        $chapter->delete();
        return redirect()->route('chapters.index');
    }
    public function getSections($classId)
    {
        $sections = Section::where('class_id', $classId)->get();
        return response()->json($sections);
    }

}
