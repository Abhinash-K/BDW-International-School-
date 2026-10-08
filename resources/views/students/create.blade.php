@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Student</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Roll Number</label>
            <input type="text" name="roll_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" required max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label>Father's Name</label>
            <input type="text" name="father_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Father's Contact</label>
            <input type="text" name="father_contact" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mother's Name</label>
            <input type="text" name="mother_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mother's Contact</label>
            <input type="text" name="mother_contact" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Guardian's Name</label>
            <input type="text" name="guardian_name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Guardian's Contact</label>
            <input type="text" name="guardian_contact" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Student</button>
    </form>
</div>
@endsection
