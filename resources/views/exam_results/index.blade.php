@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Enter Exam Results</h2>

    <!-- Exam & Class Selection Form -->
    <div class="card">
        <div class="card-body">
            <form id="fetchResultsForm">
                <div class="row">
                    <div class="col-md-4">
                        <label for="exam_id">Select Examination</label>
                        <select id="exam_id" class="form-control" required>
                            <option value="">-- Select Exam --</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->exam_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="class_id">Select Class</label>
                        <select id="class_id" class="form-control" required>
                            <option value="">-- Select Class --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="button" id="fetchResultsBtn" class="btn btn-primary mt-4">Fetch</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Table -->
    <div class="card mt-4" id="resultsCard" style="display: none;">
        <div class="card-body">
            <h4>Enter Marks</h4>
            <form id="saveResultsForm">
                <input type="hidden" id="exam_id_hidden">
                <input type="hidden" id="class_id_hidden">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody id="resultsTableBody"></tbody>
                </table>
                <button type="submit" class="btn btn-success">Save Results</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    // Fetch students and subjects when clicking the fetch button
    $("#fetchResultsBtn").click(function() {
        let exam_id = $("#exam_id").val();
        let class_id = $("#class_id").val();

        if (!exam_id || !class_id) {
            alert("Please select both exam and class.");
            return;
        }

        $("#exam_id_hidden").val(exam_id);
        $("#class_id_hidden").val(class_id);

        $.ajax({
            url: "{{ route('exam-results.fetch-students-subjects') }}",
            type: "POST",
            data: { exam_id: exam_id, class_id: class_id, _token: "{{ csrf_token() }}" },
            success: function(response) {
                console.log(response); // Debugging: Check response structure
                
                // Clear table content **before** processing data
                $("#resultsTableBody").empty();

                if (response.error) {
                    alert(response.error);
                    return;
                }

                let students = {}; // Store unique students
                let subjects = new Set(); // Store unique subjects

                response.forEach(item => {
                    console.log("Processing student:", item.student_id, item.student_name); // Debug each student

                    if (!students[item.student_id]) {
                        students[item.student_id] = { 
                            student_name: item.student_name, 
                            student_id: item.student_id,
                            subjects: {} 
                        };
                    }

                    subjects.add(item.subject_name);
                    students[item.student_id].subjects[item.subject_name] = item.subject_id;
                });

                console.log("Final students object:", students); // Debug final student data

                subjects = Array.from(subjects);

                // Create the table header
                let headerRow = `<tr><th>Student Name</th>`;
                subjects.forEach(subject => {
                    headerRow += `<th>${subject}</th>`;
                });
                headerRow += `</tr>`;
                $("#resultsTableBody").append(headerRow);

                // Create rows for each student
                Object.values(students).forEach(student => {
                    let row = `<tr><td>${student.student_name}</td>`;
                    subjects.forEach(subject => {
                        let subjectId = student.subjects[subject] || '';
                        row += `<td>
                                    <input type="number" name="marks_obtained[${student.student_id}][${subjectId}]" class="form-control" min="0" max="100">
                                    <input type="hidden" name="student_id[]" value="${student.student_id}">
                                    <input type="hidden" name="subject_id[]" value="${subjectId}">
                                </td>`;
                    });
                    row += `</tr>`;
                    $("#resultsTableBody").append(row);
                });

                $("#resultsCard").show();
            },
            error: function(xhr) {
                alert("Failed to fetch students and subjects. " + xhr.responseText);
            }
        });
    });

    // Submit the results form
    $("#saveResultsForm").submit(function(e) {
        e.preventDefault();

        let formData = {
            exam_id: $("#exam_id_hidden").val(),
            class_id: $("#class_id_hidden").val(),
            results: []
        };

        $("#resultsTableBody tr").each(function() {
            let student_id = $(this).find("input[name='student_id[]']").val();
            let subject_id = $(this).find("input[name='subject_id[]']").val();
            let marks_obtained = $(this).find("input[name^='marks_obtained']").val();

            formData.results.push({
                student_id: student_id,
                subject_id: subject_id,
                marks_obtained: marks_obtained
            });
        });

        $.ajax({
            url: "{{ route('exam-results.store') }}",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            success: function(response) {
                alert("Results saved successfully!");
                location.reload();
            },
            error: function() {
                alert("Error saving results.");
            }
        });
    });
});

</script>
    
@endsection
