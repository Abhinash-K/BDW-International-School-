<x-layout>
    <div class="page-wrapper">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Examination</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Examination</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('examinations.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Exam Type</label>
                                    <input type="text" class="form-control" name="exam_type" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Class</label>
                                    <div class="row">
                                        @foreach ($classes as $class)
                                            <div class="col-md-3">
                                                <input type="checkbox" name="class_ids[]" value="{{ $class->id }}">
                                                {{ $class->class }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="exam_date_from" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="exam_date_to" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Calendar</label>
                                    <select class="form-control" name="calendar_id">
                                        <option value="">None</option>
                                        @foreach($calendars as $calendar)
                                            <option value="{{ $calendar->id }}">{{ $calendar->month }} - {{ $calendar->date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Weightage (%)</label>
                                    <input type="number" class="form-control" name="weightage" min="0" max="100">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Exam</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</x-layout>
