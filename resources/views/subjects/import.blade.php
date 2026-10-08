@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
@if(session('error'))
    <div>{{ session('error') }}</div>
@endif

<form action="{{ route('subjects.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Import Subjects</button>
</form>
