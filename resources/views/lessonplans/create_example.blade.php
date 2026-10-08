
<x-layout>
    @section('content')
        <div class="modal fade" id="addRowModal" tabindex="-1" aria-labelledby="addRowModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRowModalLabel">Task Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addRowForm">
                            <div class="mb-3">
                                <label for="taskContent" class="form-label">Task</label>
                                <textarea class="froala-editor form-control" id="taskContent" name="taskContent" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="page-wrapper" >
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Chapters</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="subjects.html">chapter</a></li>
                            <li class="breadcrumb-item active">Add chapters</li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('lessonplans.store', $academicyear) }}" method="POST" class="form-floating">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="chapter_name" class="form-label">Chapter-Name</label>
                                        @php
                                            $cYear = $academicyear::where('current', '=', 1)->get();
                
                                        @endphp
                
                                        <input type="text" id="chapter_name" name="chapter_name" required
                                            class="form-control @error('chapter_name') border-danger @enderror" value="{{ old('chapter_name') }}">
                                        @error('chapter_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="year_id" class="form-label">Year</label>
                                        <input type="number" id="year_id" name="year_id" required
                                            class="form-control @error('year_id') border-danger @enderror"
                                            value="{{ $cYear[0]->year }}">
                                        @error('year_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="class_id" class="form-label">Class</label>
                                        <!-- <select name="class_id" id="class_id"></select>
                                        @error('class_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror -->
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                        </select>
                                    </div>
                                    
                                   
                                    {{-- <div class="col">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" id="start_time" name="start_time"
                                            class="form-control @error('start_time') border-danger @enderror"
                                            value="{{ old('start_time') }}">
                                        @error('start_time')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="col">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" id="end_time" name="end_time"
                                            class="form-control @error('end_time') border-danger @enderror"
                                            value="{{ old('end_time') }}">
                                        @error('end_time')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                </div>
                                <div class="row mb-3">
                                    <!-- <div class="col">
                                        <label for="subject_id" class="form-label">Subject</label>
                                        <select name="subject_id" id="subject_id"></select>
                                        @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> -->
                                    <div class="col">
                                        <label for="teacher" class="form-label fw-bold">Teacher</label>
                                        <div class="card p-3 bg-light">
                                            <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                            <p class="mb-0"><strong>Name:</strong> {{ auth()->user()->username }}</p>
                                        </div>
                                        @error('teacher_id')
                                            <p class="text-danger mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="form-control @error('start_date') border-danger @enderror"
                                            value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" id="end_date" name="end_date"
                                            class="form-control @error('end_date') border-danger @enderror"
                                            value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <span id="addRow" class="btn btn-sm btn-primary mb-5" style="float:right"
                                                        data-bs-toggle="modal" data-bs-target="#addRowModal">Add
                                                        Lesson Plan</span>
                                        <table id="plansList">
                                            <thead>
                                                <th style="width:5%">sl no.</th>
                                                <th style="width:85%">Task</th>
                                                <th style="width:10%"></th>
                                            </thead>
                                            <tbody>
                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col p-2">
                                        <button type="submit" class="btn btn-primary">Add Chapter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @endsection
    @push('scripts')
        <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/tom-select.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/css/froala_editor.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/js/froala_editor.min.js"></script>
        <!-- Froala CSS -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/css/froala_editor.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/css/plugins/table.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/css/plugins/align.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/css/plugins/file.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.3.1/css/plugins/image.min.css"
            integrity="sha512-zcSicxE2mavjzSKdeN8rSx8164sB0y9mnV93nl/2Im1BFsLAFFuV1/ZkOmkLwQkdAQb6WqS2tXVJmR1xmXTZCA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
            
            <!-- Add Lightbox2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
        <!-- Add Lightbox2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.4.1/js/tom-select.complete.min.js"
            integrity="sha512-CzUoi6nF16H/slapry/mFOHL612D79pnWNTmaLuf6XEv7ThODevxvFNu26TkzIT/J25phJWjwYmX6DDXh6uQzA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Froala JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/js/froala_editor.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/js/plugins/table.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/js/plugins/align.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.1.1/js/plugins/file.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.3.1/js/plugins/image.min.js"
            integrity="sha512-hdpWU+frTvpOVxB/8CPdy1wZZBdAuws5mK19LU/RaQauTKbOlmwf/NRT5g1d90T63DRvaWhntyq36DeYnvjDig=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     let rowCount = 0;

            //     new TomSelect('#class_id', {
            //         valueField: 'id', // Use a unique identifier for each item
            //         labelField: 'class', // Display the class name
            //         searchField: ['class', 'section'], // Search by class or section
            //         load: function(query, callback) {
            //             if (!query.length) return callback();
            //             var url = `{{ url('fetchClasses') }}?q=` + encodeURIComponent(query);
            //             fetch(url)
            //                 .then(response => response.json())
            //                 .then(json => {
            //                     console.log(json);
            //                     callback(
            //                         json.map(item => ({
            //                             id: item.id, // Create a unique id
            //                             class: item.class,
            //                             section: item.section
            //                         }))
            //                     );
            //                 })
            //                 .catch(() => {
            //                     callback();
            //                 });
            //         },
            //         render: {
            //             option: function(item, escape) {
            //                 return `<div>${escape(item.class)}-${escape(item.section)}</div>`; // Render the item
            //             },
            //             item: function(item, escape) {
            //                 return `<div>${escape(item.class)}-${escape(item.section)}</div>`; // Render the selected item
            //             }
            //         }
            //     });
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

            $(document).on('submit', '#lessonPlanForm', function(event) {
            event.preventDefault(); // Prevent page refresh

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('lessonplans.store') }}", // Ensure this matches your Laravel route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#lessonPlanForm')[0].reset(); // Clear form fields
                    $('#addLessonModal').modal('hide'); // Hide modal if applicable
                    $('#SubjectList').DataTable().ajax.reload(); // Reload DataTable
                },
                error: function(xhr) {
                    alert("Error adding lesson plan.");
                    console.error(xhr.responseText);
                }
            });
        });

            document.addEventListener("DOMContentLoaded", function () {
                let classDropdown = document.getElementById("class_id");

                if (!classDropdown) {
                    console.error("Dropdown element not found! Make sure the ID is correct.");
                    return;
                }

                fetch("/get-assigned-classes")
                    .then(response => response.json())
                    .then(data => {
                        console.log("Fetched assigned classes:", data);

                        // Initialize TomSelect only after fetching data
                        let ts = new TomSelect("#class_id", {
                            valueField: "class_id",
                            labelField: "display_text",
                            searchField: ["display_text"],
                            options: data.map(item => ({
                                class_id: item.class_id,
                                display_text: `Class ${item.class} : ${item.subject}`
                            })),
                            render: {
                                option: function (item, escape) {
                                    return `<div>${escape(item.display_text)}</div>`;
                                },
                                item: function (item, escape) {
                                    return `<div>${escape(item.display_text)}</div>`;
                                }
                            }
                        });

                        console.log("TomSelect initialized successfully.");
                    })
                    .catch(error => {
                        console.error("Error fetching assigned classes:", error);
                    });
            });


                new TomSelect('#teacher_id', {
                    valueField: 'id', // Use a unique identifier for each item
                    labelField: 'username', // Display the class name
                    searchField: ['username', 'email'], // Search by class or section
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        var url = `{{ url('fetchTechers') }}?q=` + encodeURIComponent(query);
                        fetch(url)
                            .then(response => response.json())
                            .then(json => {
                                console.log(json);
                                callback(
                                    json.map(item => ({
                                        id: item.id, // Create a unique id
                                        username: item.username,
                                        email: item.email
                                    }))
                                );
                            })
                            .catch(() => {
                                callback();
                            });
                    },
                    render: {
                        option: function(item, escape) {
                            return `<div>${escape(item.username)} (${escape(item.email)})</div>`; // Render the item
                        },
                        item: function(item, escape) {
                            return `<div>${escape(item.username)} (${escape(item.email)})</div>`; // Render the selected item
                        }
                    }
                });

                new TomSelect('#subject_id', {
                    valueField: 'id', // Use a unique identifier for each item
                    labelField: 'subject', // Display the class name
                    searchField: ['subject'], // Search by class or section
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        var url = `{{ url('fetchSubjects') }}?q=` + encodeURIComponent(query);
                        fetch(url)
                            .then(response => response.json())
                            .then(json => {
                                console.log(json);
                                callback(
                                    json.map(item => ({
                                        id: item.id, // Create a unique id
                                        subject: item.subject,
                                    }))
                                );
                            })
                            .catch(() => {
                                callback();
                            });
                    },
                    render: {
                        option: function(item, escape) {
                            return `<div>${escape(item.subject)}</div>`; // Render the item
                        },
                        item: function(item, escape) {
                            return `<div>${escape(item.subject)}</div>`; // Render the selected item
                        }
                    }
                });

                /**
                 * Rich Text Initializer
                 */


                function initializeFroala() {
                    new FroalaEditor('.froala-editor', {
                        toolbarInline: false,
                        charCounterCount: true,
                        height: 300,
                        toolbarButtons: [
                            'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
                            '|', 'align', 'formatOL', 'formatUL', 'insertTable',
                            '|', 'insertLink', 'insertImage', 'insertFile', 'undo', 'redo'
                        ],
                        pluginsEnabled: ['align', 'table', 'file', 'image'],
                        fileUploadURL: '/upload_file', // For general file uploads
                        imageUploadURL: '/upload_image', // For image uploads
                        fileAllowedTypes: [
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/jpeg', // Allow JPEG images
                            'image/png' // Allow PNG images
                        ],
                        fileMaxSize: 10 * 1024 * 1024, // 10 MB limit
                        events: {
                            'file.beforeUpload': function(files) {
                                console.log('Uploading file:', files[0].name);
                            },
                            'image.beforeUpload': function(files) {
                                console.log('Uploading image:', files[0].name);
                            }
                        },
                        requestHeaders: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                }


                // Add row function

                document.getElementById('addRowForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    rowCount++;

                    // Get the task content
                    const taskContent = document.getElementById('taskContent').value;

                    // Add new row to the table
                    const tbody = document.querySelector('#plansList tbody');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${rowCount}</td>
                        <td><textarea class="hidden" name="content_${rowCount}">${taskContent}</textarea>${taskContent}</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-row">Delete</button>
                        </td>
                    `;
                    tbody.appendChild(newRow);
                    initializeFroala();
                    
                    // document.getElementById('addRowForm').reset();
                });

                // Delete row functionality
                document.getElementById('plansList').addEventListener('click', function(event) {
                    if (event.target.classList.contains('delete-row')) {
                        const row = event.target.closest('tr');
                        row.remove();
                        rowCount--; // Adjust the row count
                    }
                });

                // Initialize Froala editor for existing textarea
                initializeFroala();
                document.getElementById('class_id').addEventListener('change', function() {
                    let classId = this.value;
                    fetch(`/get-sections/${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            let sectionDropdown = document.getElementById('section_name');
                            sectionDropdown.innerHTML = "<option value=''>Select Section</option>";
                            data.forEach(section => {
                                sectionDropdown.innerHTML += `<option value="${section.id}">${section.section_name}</option>`;
                            });
                        });
                });
            
    </script>
    @endpush

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/get-assigned-classes')
            .then(response => response.json())
            .then(data => {
                let classDropdown = document.getElementById('class_id');
                classDropdown.innerHTML = '<option value="">Select Class</option>'; // Default option
                
                data.forEach(item => {
                    let option = document.createElement('option');
                    option.value = item.class_id;
                    option.textContent = `Class ${item.class} : ${item.subject}`;
                    classDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching assigned classes:', error));
    });
</script>


</x-layout>