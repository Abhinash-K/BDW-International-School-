<x-layout>
    <div class="page-wrapper">
        <div class="content container-fluid">
    
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">List Classes</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">List Classes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Name ...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search by Phone ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="btn" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </div> --}}
    
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table table-hover table-center mb-0" id="ClassList">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Class</th>
                                            <th>Section</th>
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
    
    {{-- model elete --}}
    <div class="modal custom-modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Class</h3>
                        <p>Are you sure want to delete?</p>
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
    
    @section('script')
    {{-- delete js --}}
    <script>
        $(document).on('click','.delete',function()
        {
            var recordId = $(this).data('id'); // Get ID from the button
            $('#record_id').val(recordId); // Set the value inside hidden input

            var deleteUrl = "{{ route('classes.destroy', ':id') }}"; // Get route
            deleteUrl = deleteUrl.replace(':id', recordId); // Replace :id with actual record ID

            $('#deleteForm').attr('action', deleteUrl); // Set form action dynamically
        });
    </script>
    
    {{-- get user all js --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ClassList').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searching: true,
            ajax: {
                url:"{{ route('getClasses') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'class',
                    name: 'class'
                },
                {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'modify',
                    name: 'modify',
                },
            ]
        });
        });
    </script>
    
</x-layout>
