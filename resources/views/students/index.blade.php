@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Students List</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Roll Number</th>
                <th>Father Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->student_id }}</td>
                <td>{{$student->name}}
                <td>{{ $student->class->class}}</td>
                <td>{{ $student->roll_number }}</td>
                <td>{{ $student->father_contact }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
