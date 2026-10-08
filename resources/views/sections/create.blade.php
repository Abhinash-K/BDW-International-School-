@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Section</h2>

    <form action="{{ route('sections.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="section_name" class="form-label">Section Name</label>
            <input type="text" name="section_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="class_id" class="form-label">Select Class</label>
            <select id="class_id" name="class_id" class="form-control" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Section</button>
    </form>
</div>
@endsection
