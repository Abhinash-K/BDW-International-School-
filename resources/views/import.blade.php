<!-- <!DOCTYPE html>
<html>
<head>
    <title>Import Excel</title>
</head>
<body>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload & Import</button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2>Import Teacher Data</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file" class="form-label">Upload Excel File</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload & Import</button>
        </form>
    </div>

</body>
</html>
