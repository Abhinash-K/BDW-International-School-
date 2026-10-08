@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Event Details</h2>
    <p><strong>Type:</strong> {{ $event->event_type }}</p>
    <p><strong>Name:</strong> {{ $event->event_name }}</p>
    <p><strong>Start Date:</strong> {{ $event->start_date }}</p>
    <p><strong>End Date:</strong> {{ $event->end_date }}</p>
    <a href="{{ route('events.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection