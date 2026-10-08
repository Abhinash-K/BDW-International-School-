@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Event</h2>
    <form action="{{ route('events.update', $event->event_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Event Type</label>
            <input type="text" name="event_type" class="form-control" value="{{ $event->event_type }}" required>
        </div>
        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control" value="{{ $event->event_name }}" required>
        </div>
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $event->start_date }}" required>
        </div>
        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $event->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection