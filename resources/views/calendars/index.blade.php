
<x-layout>
    <div class="page-wrapper" style="padding-top: 0px;">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">School Calendar</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">School Calendar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover table-center mb-0">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Month</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Activity</th>
                                            <th>Holiday</th>
                                            <th>Working Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calendars as $calendar)
                                        <tr>
                                            <td>{{ $calendar->month }}</td>
                                            <td>{{ $calendar->date }}</td>
                                            <td>{{ $calendar->days }}</td>
                                            <td>{{ $calendar->activity }}</td>
                                            <td>{{ $calendar->holidays ? 'Yes' : 'No' }}</td>
                                            <td>{{ $calendar->working_details }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</x-layout>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>School Calendar</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Date</th>
                <th>Day</th>
                <th>Activity</th>
                <th>Holiday</th>
                <th>Working Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calendars as $calendar)
            <tr>
                <td>{{ $calendar->month }}</td>
                <td>{{ $calendar->date }}</td>
                <td>{{ $calendar->days }}</td>
                <td>{{ $calendar->activity }}</td>
                <td>{{ $calendar->holidays ? 'Yes' : 'No' }}</td>
                <td>{{ $calendar->working_details }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
