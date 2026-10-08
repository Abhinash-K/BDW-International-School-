<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Show all calendar entries
    public function index()
    {
        $calendars = Calendar::all();
        return view('calendars.index', compact('calendars'));
    }

    // Show form to add a calendar entry
    public function create()
    {
        return view('calendars.create');
    }

    // Store a new calendar entry
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'date' => 'required|date',
            'days' => 'required|string',
            'activity' => 'nullable|string',
            'holidays' => 'required|boolean',
            'working_details' => 'nullable|string',
        ]);

        Calendar::create($request->all());

        return redirect()->route('calendars.index')->with('success', 'Calendar entry added successfully.');
    }
}

