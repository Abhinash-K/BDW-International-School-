@extends('layouts.app')

@section('content')
<h2>Select Classes for Exam List</h2>

@foreach($classes as $class)
    <label>
        <input type="checkbox" class="class-checkbox" value="{{ $class->class }}"> {{ $class->class }}
    </label>
@endforeach

<button id="fetchExamsBtn" class="btn btn-success">Get Exams</button>

<!-- Exam List (Initially Hidden) -->
<div id="examTypesContainer" style="display: none;">
    <h3>Exam Schedule</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Exam Type</th>
                <th>Exam Date</th>
            </tr>
        </thead>
        <tbody id="examTypesTable"></tbody>
    </table>
</div>

<a href="{{ route('examinations.index') }}" class="btn btn-secondary">Back to Exams List</a>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#fetchExamsBtn').on('click', function () {
            console.log("Get Exams button clicked!");
            let selectedClasses = [];

            $('.class-checkbox:checked').each(function () {
                selectedClasses.push($(this).val());
            });

            if (selectedClasses.length === 0) {
                alert("Please select at least one class.");
                $('#examTypesContainer').hide();
                $('#examTypesTable').empty();
                return;
            }

            $.ajax({
                url: "{{ route('getExamTypesByClass') }}",
                type: "GET",
                data: { class_ids: selectedClasses },
                success: function (response) {
                    $('#examTypesTable').empty();

                    if (response.length > 0) {
                        $('#examTypesContainer').show();
                        response.forEach(function (exam) {
                            $('#examTypesTable').append(`
                                <tr>
                                    <td>${exam.class_name}</td>
                                    <td>${exam.exam_type}</td>
                                    <td>${exam.exam_date_from}</td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#examTypesContainer').hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", error);
                }
            });
        });
    });
</script>
@endsection
