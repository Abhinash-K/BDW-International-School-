@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Teacher to Class, Section & Subject</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('teacher_assignments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="teacher_id" class="form-label">Select Teacher:</label>
            <select name="teacher_id" class="form-control" required>
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="class_id" class="form-label">Select Class:</label>
            <select name="class_id" class="form-control" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="section_id" class="form-label">Select Section:</label>
            <select name="section_id" class="form-control" required>
                <option value="">-- Select Section --</option>
                @foreach($sections as $section)
                    <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Select Subject:</label>
            <select name="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Teacher</button>
    </form>
</div>
@endsection
