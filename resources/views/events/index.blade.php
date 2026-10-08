@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->event_id }}</td>
                <td>{{ $event->event_type }}</td>
                <td>{{ $event->event_name }}</td>
                <td>{{ $event->start_date }}</td>
                <td>{{ $event->end_date }}</td>
                <td>
                    <a href="{{ route('events.show', $event->event_id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
