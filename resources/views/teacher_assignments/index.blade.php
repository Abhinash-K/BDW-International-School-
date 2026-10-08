@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Teacher Assignments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Class</th>
                <th>Section</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
            <tr>
                <td>{{ $assignment->teacher->username }}</td>
                <td>{{ $assignment->class->class }}</td>
                <td>{{ $assignment->section->section_name ?? 'N/A' }}</td>
                <td>{{ $assignment->subject->subject }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
