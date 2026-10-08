<x-layout>
    
    <div class="page-wrapper" style="position: absolute !important; top: 0px !important; width: 80%;">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Update Chapters</h3>
            {{-- <a href="{{ route('lessonplans.index') }}" class="btn btn-primary">Back</a> --}}
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
        @elseif(session('failed'))
            <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
        @endif
        <form action="{{ route('lessonplans.update', $lessonplan, $academicyear) }}" method="POST" class="form-floating">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column gap-3">
                <div class="row">
                    <div class="col">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" required
                            class="form-control @error('title') border-danger @enderror"
                            value="{{ $lessonplan->title }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="year_id" class="form-label">Year</label>
                        <input type="number" id="year_id" name="year_id" required
                            class="form-control @error('year_id') border-danger @enderror"
                            value="{{ $academicyear::where('id',"=", $lessonplan->year_id)->first()->year }}">
                        @error('year_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="class_id" class="form-label">Class</label>
                        <select name="class_id" id="class_id" data-default-id="{{ $lessonplan->class_id }}"></select>
                        @error('class_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id"
                            data-default-id="{{ $lessonplan->subject_id }}"></select>
                        @error('subject_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="teacher_id" class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id"
                            data-default-id="{{ $lessonplan->teacher_id }}"></select>
                        @error('teacher_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required
                            class="form-control @error('start_date') border-danger @enderror"
                            value="{{ $lessonplan->start_date }}">
                        @error('start_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" id="end_date" name="end_date" required
                            class="form-control @error('end_date') border-danger @enderror"
                            value="{{ $lessonplan->end_date }}">
                        @error('end_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" id="start_time" name="start_time" required
                            class="form-control @error('start_time') border-danger @enderror"
                            value="{{ $lessonplan->start_time }}">
                        @error('start_time')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    {{-- <div class="col">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" id="end_time" name="end_time" required
                            class="form-control @error('end_time') border-danger @enderror"
                            value="{{ $lessonplan->end_time }}">
                        @error('end_time')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col">
                        <table id="plansList">
                            <thead>
                                <th style="width:5%">sl no.</th>
                                <th style="width:85%">Task</th>
                                <th style="width:10%"><span id="addRow" class="btn btn-sm btn-primary">Add
                                        Row</span></th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $metas = unserialize($lessonplan->tasks);
                                @endphp
                                @foreach ($metas as $value)
                                    @php
                                        $i++;
                                        // $checkedAt = $value["checkedAt_$i"];
                                        $content = $value["content_$i"];
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <textarea class="froala-editor" name="content_{{$i}}">{{ $content }}</textarea>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger delete-row">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('lessonplans.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
        </form>
    </div>
    
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
            document.addEventListener('DOMContentLoaded', function() {
                let rowCount = document.querySelectorAll('#plansList tbody tr').length;

                new TomSelect('#class_id', {
                    valueField: 'id', // Use a unique identifier for each item
                    labelField: 'class', // Display the class name
                    searchField: ['class', 'section'], // Search by class or section
                    onInitialize: function() {
                        var class_id = $("#class_id").attr("data-default-id");
                        if (class_id != null) {
                            var url = `{{ url('fetchClasses') }}?q=` + encodeURIComponent(class_id);
                            fetch(url)
                                .then(response => response.json())
                                .then(json => {
                                    if (json.length > 0) {
                                        var item = json[
                                            0]; // Assuming the first item is the desired one
                                        this.addOption(item); // Add the option
                                        this.addItem(item.class); // Select the option
                                        this.setValue(item.id);
                                    }

                                }).catch((e) => {
                                    alert("class not founde" + `${e}`);
                                });
                        }
                    },
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        var url = `{{ url('fetchClasses') }}?q=` + encodeURIComponent(query);
                        fetch(url)
                            .then(response => response.json())
                            .then(json => {
                                callback(
                                    json.map(item => ({
                                        id: item.id, // Create a unique id
                                        class: item.class,
                                        section: item.section
                                    }))
                                );
                            })
                            .catch(() => {
                                callback();
                            });
                    },
                    render: {
                        option: function(item, escape) {
                            return `<div>${escape(item.class)}-${escape(item.section)}</div>`; // Render the item
                        },
                        item: function(item, escape) {
                            return `<div>${escape(item.class)}-${escape(item.section)}</div>`; // Render the selected item
                        }
                    }
                });

                new TomSelect('#teacher_id', {
                    valueField: 'id', // Use a unique identifier for each item
                    labelField: 'username', // Display the class name
                    searchField: ['username', 'email'], // Search by class or section
                    onInitialize: function() {
                        var class_id = $("#teacher_id").attr("data-default-id");
                        if (class_id != null) {
                            var url = `{{ url('fetchTechers') }}?q=` + encodeURIComponent(class_id);
                            fetch(url)
                                .then(response => response.json())
                                .then(json => {
                                    if (json.length > 0) {
                                        var item = json[
                                            0]; // Assuming the first item is the desired one
                                        this.addOption(item); // Add the option
                                        this.addItem(item.username); // Select the option
                                        this.setValue(item.id);
                                    }

                                }).catch((e) => {
                                    alert("class not founde" + `${e}`);
                                });
                        }
                    },
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        var url = `{{ url('fetchTechers') }}?q=` + encodeURIComponent(query);
                        fetch(url)
                            .then(response => response.json())
                            .then(json => {
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
                    onInitialize: function() {
                        var class_id = $("#subject_id").attr("data-default-id");
                        if (class_id != null) {
                            var url = `{{ url('fetchSubjects') }}?q=` + encodeURIComponent(class_id);
                            fetch(url)
                                .then(response => response.json())
                                .then(json => {
                                    if (json.length > 0) {
                                        var item = json[
                                            0]; // Assuming the first item is the desired one
                                        this.addOption(item); // Add the option
                                        this.addItem(item.subject); // Select the option
                                        this.setValue(item.id);
                                    }

                                }).catch((e) => {
                                    alert("class not founde" + `${e}`);
                                });
                        }
                    },
                    load: function(query, callback) {
                        if (!query.length) return callback();
                        var url = `{{ url('fetchSubjects') }}?q=` + encodeURIComponent(query);
                        fetch(url)
                            .then(response => response.json())
                            .then(json => {
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
                document.getElementById('addRow').addEventListener('click', function() {
                    rowCount++;
                    const tbody = document.querySelector('#plansList tbody');
                    const newRow = document.createElement('tr');

                    newRow.innerHTML = `
                <td>${rowCount}</td>
                <td>
                    <textarea class="froala-editor" name="content_${rowCount}"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger delete-row">Delete</button>
                </td>
            `;

                    tbody.appendChild(newRow);
                    initializeFroala(); // Initialize Froala for the new textarea
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


            });
        </script>
@endpush

</x-layout>