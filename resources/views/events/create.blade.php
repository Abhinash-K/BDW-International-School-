@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Event</h2>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Event Type</label>
            <input type="text" name="event_type" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection