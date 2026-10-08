@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Subjects to Student</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('students.assignSubjects', $student->student_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Select Subjects</label>
            <select name="subject_ids[]" class="form-control" multiple>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Subjects</button>
    </form>
</div>
@endsection
