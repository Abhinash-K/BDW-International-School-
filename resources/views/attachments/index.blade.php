<x-layout>
    <div class="container" style="width:100%;">
        <div class="d-flex flex-row justify-content-between">
            <h2>Attachments</h2>
            <a href="{{ route('attachments.index') }}" class="btn btn-primary">Back</a>
        </div>
        @php
            $previewExt = ['png', 'jpeg', 'jpg', 'avif', 'webp'];
        @endphp

        @if ($paginatedFiles && count($paginatedFiles) > 0)
            <ul class="media-attachments">
                @foreach ($paginatedFiles as $file)
                    @if (in_array($file['extension'], $previewExt))
                        <li style="font-size:.5em;">
                            <img src="{{ asset('storage/' . $file['path']) }}">
                            <strong>Name:</strong> {{ $file['name'] }} <br>
                            <strong>Extension:</strong> {{ $file['extension'] }} <br>
                            <strong>Path:</strong> {{ $file['path'] }} <br>
                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">View</a>
                        </li>
                    @else
                        <li>
                            <img src="http://127.0.0.1:8000/storage/uploads/images/documents.png">
                            <strong>Name:</strong> {{ $file['name'] }} <br>
                            <strong>Extension:</strong> {{ $file['extension'] }} <br>
                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">View</a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Pagination links -->
            {{ $paginatedFiles->links() }}
        @else
            <p>No files found.</p>
        @endif
        
        <style>
            .media-attachments {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                width: 100%;
            }

            .media-attachments li {
                width: 12.5%;
                overflow: hidden;
            }

            .media-attachments li img {
                width: 100%;
                height: 150px;
                object-fit: cover;
            }
        </style>

    </div>
</x-layout>