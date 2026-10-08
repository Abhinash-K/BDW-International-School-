<x-layout>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">All Examinations</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Examinations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <a href="{{ route('examinations.create') }}" class="btn btn-primary">Add Exam</a>
                </div>
                <div class="col-sm-6 text-end">
                    <form action="{{ route('examinations.deleteAll') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete ALL exams?');">
                            Delete All
                        </button>
                    </form>
                </div>
            </div>

            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Exam Type</th>
                                    <th>Class</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Calendar</th>
                                    <th>Weightage (%)</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examinations as $exam)
                                <tr>
                                    <td>{{ $exam->exam_type }}</td>
                                    <td>
                                        @foreach ($exam->classes as $class)
                                            {{ $class->class }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>{{ $exam->exam_date_from }}</td>
                                    <td>{{ $exam->exam_date_to }}</td>
                                    <td>{{ optional($exam->calendar)->month }}</td>
                                    <td>{{ $exam->weightage }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('examinations.edit', $exam->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('examinations.destroy', $exam->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this exam?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
