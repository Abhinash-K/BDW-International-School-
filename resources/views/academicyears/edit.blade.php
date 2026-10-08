<x-layout>
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="">Update Academic Years</h2>
            <a href="{{ route('academicyears.index') }}" class="btn btn-primary">Back</a>
        </div>
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
        @elseif(session('failed'))
            <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
        @endif
        
        <form action="{{ route('academicyears.update',$academicyear) }}" method="POST" class="form-floating">
            @csrf
            @method("PUT")
            <div class="d-flex flex-column gap-3">
                <div class="row">
                    <div class="col">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" id="year" name="year" required
                            class="form-control @error('year') border-danger @enderror" value="{{ $academicyear->year }}">
                        @error('year')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="current" class="form-label">Current Year</label>
                        <input type="checkbox" id="current" name="current"
                        class="form-check-input" 
                        @if ($academicyear->current == 1)
                            @checked(true)
                        @endif>
                        @error('current')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
        </form>
    </div>
</x-layout>
