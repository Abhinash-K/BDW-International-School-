<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\ClassModel;

class SectionController extends Controller
{
    // Display all sections
    public function index()
    {
        $sections = Section::with('class')->get();
        return view('sections.index', compact('sections'));
    }

    // Show the form for creating a new section
    public function create()
    {
        $classes = ClassModel::all();
        return view('sections.create', compact('classes'));
    }

    // Store a new section in the database
    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        Section::create([
            'section_name' => $request->section_name,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section added successfully.');
    }
    public function getSections($classId)
    {
        // Fetch sections based on class ID
        $sections = Section::where('class_id', $classId)->get();

        // Return the sections as JSON response
        return response()->json($sections);
    }

}
