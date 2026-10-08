@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sections</h2>
    <a href="{{ route('sections.create') }}" class="btn btn-primary">Add Section</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Section Name</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td>{{ $section->section_id }}</td>
                <td>{{ $section->section_name }}</td>
                <td>{{ $section->class->class }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
