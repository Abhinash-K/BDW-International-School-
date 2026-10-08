
<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="modal fade" id="lessonDetailsModal" tabindex="-1" role="dialog" aria-labelledby="lessonDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">    
                    <h5 class="modal-title" id="lessonDetailsModalLabel">Chapter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true">&times;</span> --}}
                    </button>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <div class="plan-details">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Chapters</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lesson Plans</li>
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
                                <table class="table table-stripped table table-hover table-center mb-0" id="SubjectList">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>class</th>
                                            <th>section</th>
                                            <th>subject</th>
                                            <th>Teacher</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- model delete --}}
    <div class="modal custom-modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Lesson Plan</h3>
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE') <!-- Add this for delete requests -->
                                <input type="hidden" name="record_id" id="record_id" value="">
                                <div class="row justify-content-center text-center">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary" style="width: 50%;">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a data-bs-dismiss="modal" class="btn btn-primary" style="width: 50%;">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------------------------------- Image Lightbox Modal ---------------------------------------------------->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <img src="" class="img-fluid" alt="Clicked Image" style="max-width: 100%; max-height: 100vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-dialog {
        width: 100%;
        max-width: 100%;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .modal-content {
            height: 100%;
        }

        .modal-body img {
            max-width: 100%;
            max-height: 100vh;
            object-fit: contain;
        }
    </style>
    
    {{-- -------------------------------------------------------------------------------------------------------------------------------- --}}

    {{-- ----------------------------------------------status modal------------------------------------------------------- --}}
   
    {{-- <div class="modal fade" id="lessonStatusModal" tabindex="-1" aria-labelledby="lessonStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lessonStatusModalLabel">Lesson Plan Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Lesson Plan</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                </tr>
                        </thead>
                        <tbody id="lessonStatusTable">
                            <!-- Content will be loaded dynamically -->
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="lessonStatus"> <b> Select Status </b></label>
                            <select class="form-select" id="lessonStatus" required>
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="button" class="btn btn-primary" id="updateStatusBtn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    

    {{-- ------------------------------------------------------------------------------------------------------------------------- --}}


    
    
    @section('script')
    {{-- delete js --}}
    {{-- todo fix this shit !!important --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("/lesson-plans-json") // Fetch all lesson plans
                .then(response => response.json())
                .then(data => {
                    populateSubjectsDropdown(data); // Populate dropdown
                    renderLessonPlans(data); // Initially show all lesson plans

                    document.getElementById("subjectFilter").addEventListener("change", function () {
                        let selectedSubject = this.value;
                        let filteredData = selectedSubject ? data.filter(plan => plan.subject_id == selectedSubject) : data;
                        renderLessonPlans(filteredData);
                    });
                })
                .catch(error => console.error("Error fetching lesson plans:", error));
        });

        function populateSubjectsDropdown(lessonPlans) {
            let subjects = [...new Set(lessonPlans.map(plan => ({ id: plan.subject_id, name: plan.subject_name })))]; // Unique subjects
            let dropdown = document.getElementById("subjectFilter");

            subjects.forEach(subject => {
                let option = document.createElement("option");
                option.value = subject.id;
                option.textContent = subject.name;
                dropdown.appendChild(option);
            });
        }

        function renderLessonPlans(data) {
            let lessonPlansList = document.getElementById("lesson-plans-list");
            lessonPlansList.innerHTML = ""; // Clear previous data

            if (data.length > 0) {
                data.forEach(plan => {
                    let row = `
                        <tr>
                            <td>${plan.title}</td>
                            <td>${plan.subject_name}</td>
                            <td>${plan.status}</td>
                        </tr>
                    `;
                    lessonPlansList.innerHTML += row;
                });
            } else {
                lessonPlansList.innerHTML = `<tr><td colspan="3">No lesson plans available.</td></tr>`;
            }


       // ---------delete--------------
        $(document).on('click', '.delete', function() {
            event.stopPropagation();
            var recordId = $(this).data('id'); // Get ID from the button
            $('#record_id').val(recordId); // Set the value inside hidden input

            var deleteUrl = "{{ route('lessonplans.destroy', ':id') }}"; // Get route
            deleteUrl = deleteUrl.replace(':id', recordId); // Replace :id with actual record ID

            $('#deleteForm').attr('action', deleteUrl); // Set form action dynamically
        });

    </script>
    
    {{-- get user all js --}}
    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('#SubjectList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url:"{{ route('getLessonplans') }}",
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'class', name: 'class' },
                    { data: 'section', name: 'section' },
                    { data: 'subject', name: 'subject' },
                    { data: 'teacher', name: 'teacher' },
                    { 
                        data: 'status', 
                        name: 'status',
                        render: function(data, type, row) {
                            let selectedPending = data === "Pending" ? "selected" : "";
                            let selectedOngoing = data === "Ongoing" ? "selected" : "";
                            let selectedCompleted = data === "Completed" ? "selected" : "";

                            return `
                                <select class="form-select status-dropdown" data-id="${row.id}">
                                    <option value="Pending" ${selectedPending}>Pending</option>
                                    <option value="Ongoing" ${selectedOngoing}>Ongoing</option>
                                    <option value="Completed" ${selectedCompleted}>Completed</option>
                                </select>
                            `;
                        }
                    },
                    // ----------------------------------------------status modal-----------------------------------------
                    // { 
                    //     data: 'status', 
                    //     name: 'status',
                    //     render: function(data, type, row) {
                    //         let statusClass = "";
                    //         if (data === "Pending") statusClass = "btn-warning";
                    //         else if (data === "Ongoing") statusClass = "btn-primary";
                    //         else if (data === "Completed") statusClass = "btn-success";

                    //         return `
                    //             <button class="btn ${statusClass} btn-sm view-status" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#lessonStatusModal">
                    //                 ${data}
                    //             </button>
                    //         `;
                    //     }
                    // },
                    // ------------------------------------------------------------------------------------------------------------
                    { data: 'modify', name: 'modify' },
                ]
            });
            // Prevent row click when interacting with the status dropdown
            $(document).on("click", ".status-dropdown", function (event) {
                event.stopPropagation(); // Stops the event from bubbling to the row
            });

            

    // Prevent delete button from triggering row click event
    $(document).on('click', '.delete', function(event) {
        event.stopPropagation(); // Fix: Prevents modal conflict

        var recordId = $(this).data('id'); // Get ID from the button
        $('#record_id').val(recordId); // Set the value inside hidden input

        var deleteUrl = "{{ route('lessonplans.destroy', ':id') }}"; // Get route
        deleteUrl = deleteUrl.replace(':id', recordId); // Replace :id with actual record ID

        $('#deleteForm').attr('action', deleteUrl); // Set form action dynamically
    });

    // Prevent submit button from triggering row click event
    $('#deleteForm').on('submit', function(event) {
        event.stopPropagation(); // Stop bubbling to the row
        event.preventDefault();  // Prevent default form submission

        let form = $(this);
        let actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#delete').modal('hide'); // Close modal
                table.ajax.reload(); // Reload DataTable
                alert('Lesson plan deleted successfully!');
            },
            error: function(xhr) {
                console.error("Error deleting record:", xhr);
                alert("Failed to delete.");
            }
        });
    });

    // script for the image to popup when the image is click -------

    $('.plan-details').on('click', 'img', function(event) {
        event.preventDefault(); // Prevent default action (if needed)
        
        let imgSrc = $(this).attr('src'); // Get the clicked image's source
        console.log("Image Clicked:", imgSrc); // Debugging log
        
        // alert(imgSrc);
        $('#imagePreviewModal .modal-body img').attr('src', imgSrc);
        $('#imagePreviewModal').modal('show');
    });

    // Row Click Event for Viewing Lesson Plan Details
    $('#SubjectList tbody').on('click', 'tr', function(event) {
        if ($(event.target).closest('.delete, .btn, .status-dropdown').length) {
            return; // Prevent opening lesson details if delete button was clicked
        }

        let data = table.row(this).data(); // Get row data
        let lessonPlanId = data.id; // Extract ID
        
        if (lessonPlanId) {
            $.ajax({
                url: `/lessonplans/details/${lessonPlanId}`, // API Endpoint to fetch details
                type: 'GET',
                success: function(response) {
                    $("#lessonDetailsModalLabel").text(response.title);
                    $(".plan-details").empty();

                    let taskListHtml = "";
                    Object.entries(response.tasks).forEach(([index, taskObj]) => {
                        Object.entries(taskObj).forEach(([key, value]) => {
                            if (key.startsWith('content_')) {
                                taskListHtml += `<li class="list-group-item">${value}</li>`;
                            }

                        });
                    });

                    let content = `<div class="p-3">
                        <div class="row">
                            <div class="col-md-4"><strong>Class:</strong> ${response.class} (${response.section})</div>
                            <div class="col-md-4"><strong>Subject:</strong> ${response.subject}</div>
                            <div class="col-md-4"><strong>Teacher:</strong> ${response.teacher}</div>
                        </div>
                        <div class="mt-3">
                            <h5>Lesson Plans</h5>
                            <ul class="list-group">${taskListHtml}</ul>
                        </div>
                    </div>`;

                    $(".plan-details").append(content);
                    $('#lessonDetailsModal').modal('show');
                },
                error: function(xhr) {
                    console.error("Error fetching details:", xhr);
                    alert("Failed to fetch details.");
                }
            });
        }
    });
});

// ---------------------------------------status modal------------------------------------------


// --------------------------------------------------------------------------------------------------------
</script>

</x-layout>