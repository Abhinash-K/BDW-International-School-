<div class="p-3">
    <h4>Lesson Plan Details</h4>
    <p><strong>Class:</strong> {{ $lessonPlan->class_name }} ({{ $lessonPlan->class_section }})</p>
    <p><strong>Subject:</strong> {{ $lessonPlan->subject_name }}</p>
    <p><strong>Teacher:</strong> {{ $lessonPlan->teacher_name }}</p>
    <p><strong>Content:</strong> {!! nl2br(e($lessonPlan->content)) !!}</p>
    <p><strong>Created At:</strong> {{ $lessonPlan->created_at }}</p>
</div>

{{-- ----------------image model------------------------ --}}

<!-- Image Preview Modal -->
{{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Lesson Image">
            </div>
        </div>
    </div>
</div> --}}
