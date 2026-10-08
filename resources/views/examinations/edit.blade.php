@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Examination</h2>
    <form action="{{ route('examinations.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Exam Type:</label>
            <input type="text" name="exam_type" class="form-control" value="{{ $exam->exam_type }}" required>
        </div>

        <div class="form-group">
            <label>Exam Date From:</label>
            <input type="date" name="exam_date_from" class="form-control" value="{{ $exam->exam_date_from }}" required>
        </div>

        <div class="form-group">
            <label>Exam Date To:</label>
            <input type="date" name="exam_date_to" class="form-control" value="{{ $exam->exam_date_to }}" required>
        </div>

        <div class="form-group">
            <label>Weightage (%):</label>
            <input type="number" name="weightage" class="form-control" value="{{ $exam->weightage }}" min="0" max="100" required>
        </div>

        <div class="form-group">
            <label>Select Classes:</label>
            @foreach($classes as $class)
            <div class="form-check">
                <input type="checkbox" name="class_ids[]" value="{{ $class->id }}"
                    class="form-check-input" 
                    @if($exam->classes->contains($class->id)) checked @endif>
                <label class="form-check-label">{{ $class->class }} - {{ $class->section }}</label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Update Exam</button>
    </form>
</div>
@endsection
