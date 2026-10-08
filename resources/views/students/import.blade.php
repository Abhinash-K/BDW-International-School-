<!DOCTYPE html>
<html>
<head>
    <title>Import Students</title>
</head>
<body>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload & Import</button>
    </form>
</body>
</html>
