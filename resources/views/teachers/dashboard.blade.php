@extends('layouts.app')

@section('content')
    <h2>Teacher Dashboard</h2>
    <p>Welcome, {{ Auth::user()->name }}</p>

    <h3>Your Assigned Classes</h3>
    <ul>
        @foreach ($classes as $class)
            <li>{{ $class->class_name }}</li>
        @endforeach
    </ul>

    <h3>Your Assigned Subjects</h3>
    <ul>
        @foreach ($subjects as $subject)
            <li>{{ $subject->subject_name }}</li>
        @endforeach
    </ul>

    <h3>Your Chapters</h3>
    <ul>
        @foreach ($chapters as $chapter)
            <li>{{ $chapter->chapter_name }}</li>
        @endforeach
    </ul>
@endsection
