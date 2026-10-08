@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Teacher Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('upload.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose Excel File:</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Upload</button>
    </form>
</div>
@endsection
