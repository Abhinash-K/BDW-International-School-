{{-- @extends('layouts.app') --}}
<x-layout>
@section('content')
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: url('https://source.unsplash.com/1600x900/?education,books') no-repeat center center fixed;
        background-size: cover;
    }
    .form-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>
</head>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="form-container p-4">
            <h3 class="text-center text-primary mb-4">✏️ Edit Chapter</h3>

            <form action="{{ route('chapters.update', $chapter->chapter_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Chapter Name</label>
                    <input type="text" name="chapter_name" class="form-control @error('chapter_name') is-invalid @enderror" value="{{ old('chapter_name', $chapter->chapter_name) }}" required>
                    @error('chapter_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Subject ID</label>
                        <input type="number" name="subject_id" class="form-control @error('subject_id') is-invalid @enderror" value="{{ old('subject_id', $chapter->subject_id) }}" required>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Class ID</label>
                        <input type="number" name="class_id" class="form-control @error('class_id') is-invalid @enderror" value="{{ old('class_id', $chapter->class_id) }}" required>
                        @error('class_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Start Date</label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $chapter->start_date) }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">End Date</label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $chapter->end_date) }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ old('status', $chapter->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="ongoing" {{ old('status', $chapter->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $chapter->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">💾 Update Chapter</button>
                    <a href="{{ route('chapters.index') }}" class="btn btn-secondary">❌ Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>
{{-- @endsection --}}


{{-- <x-layout> 
    <div> 
        <div class="d-flex flex-row justify-content-between">
            <h2 class="">Update chapter</h2>
            <a href="{{ route('chapters.index') }}" class="btn btn-primary">Back</a>
        </div>
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
        @elseif(session('failed'))
            <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
        @endif
        <form action="{{ route('chapters.update', $chapter) }}" method="POST" class="form-floating">
            @csrf
            @method("PUT")
            <div class="d-flex flex-column gap-3">
                <div class="row">
                    <div class="col">
                        <label for="chapter_name" class="form-label">Chapter Name</label> --}}
                        {{-- <input type="text" name="chapter_name" class="form-control" value="{{ old('chapter_name', $chapter->chapter_name) }}" required> --}}
                    
                        {{-- <label for="chapter" class="form-label">chapter</label> 
                        <input type="text" id="chapter" name="chapter" required class="form-control @error('chapter') border-danger @enderror" value="{{ $chapter->chapter }}">
                        @error('chapter')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Subject ID</label>
                            <input type="number" name="subject_id" class="form-control @error('subject_id') is-invalid @enderror" value="{{ old('subject_id', $chapter->subject_id) }}" required>
                            @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Class ID</label>
                            <input type="number" name="class_id" class="form-control @error('class_id') is-invalid @enderror" value="{{ old('class_id', $chapter->class_id) }}" required>
                            @error('class_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $chapter->start_date) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $chapter->end_date) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $chapter->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ongoing" {{ old('status', $chapter->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $chapter->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col p-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout> --}}