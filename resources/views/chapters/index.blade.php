<x-layout>
    @section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Chapter</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Chapter</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Search Filters -->
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Class ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Section ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Subject ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chapter List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>All Chapters</h4>
                        <a href="{{ route('chapters.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table border-0 table-hover table-center datatable table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Chapter Name</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($chapters as $chap)
                                <tr class="select-chapter" 
                                    data-id="{{ $chap->id }}" 
                                    data-name="{{ $chap->chapter_name ?? 'N/A' }}">
                                    <td class="chapter_id">{{ $chap->id }}</td>
                                    <td>{{ $chap->chapter_name ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <div class="actions">
                                            <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i class="fe fe-trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No chapter available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chapter Details Modal -->
<div class="modal fade" id="chapterModal" tabindex="-1" aria-labelledby="chapterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chapterModalLabel">Chapter Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Chapter Name:</th>
                        <td id="modal-chapter-name"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
            <a id="edit-chapter-btn" href="#" class="btn btn-primary">
                <i class="fe fe-edit"></i>
            </a>

            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal custom-modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Chapter</h3>
                    <p>Are you sure you want to delete this chapter?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <form action="{{ route('chapters.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="chapter_id" class="e_chapter_id" value="">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary paid-continue-btn" style="width: 100%;">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
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
<script>
    $(document).ready(function() {
    // Show Chapter Details in Modal when clicking on a row
    $('.select-chapter').on('click', function(e) {
        // Prevent opening modal if the delete button was clicked
        if ($(e.target).closest('.delete').length > 0) return;

        var chapterId = $(this).data('id');
        var chapterName = $(this).data('name');

        $('#modal-chapter-name').text(chapterName);
        $('#edit-chapter-btn').attr('href', '/chapter/edit/' + chapterId);
        $('#chapterModal').modal('show');
    });

    // Set Chapter ID in Delete Modal
    $(document).on('click', '.delete', function(e) {
        e.stopPropagation(); // Prevent triggering row click event
        var _this = $(this).closest('tr');
        $('.e_chapter_id').val(_this.find('.chapter_id').text());
    });
    
});

</script>
@endsection
@endsection
</x-layout>

