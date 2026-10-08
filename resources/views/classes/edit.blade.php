<x-layout>
    <div class="page-wrapper" style="position: absolute !important; top: 0px !important; width: 1200px;">
        <div class="content container-fluid" style="width: 100%;">
            <div class="d-flex flex-row justify-content-between">
                <h3 class="">Update class</h3>
                <a href="{{ route('classes.index') }}" class="btn btn-primary">Back</a>
            </div>
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
            @elseif(session('failed'))
                <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
            @endif
            <form action="{{ route('classes.update',$class) }}" method="POST" class="form-floating">
                @csrf
                @method("PUT")
                <div class="d-flex flex-column gap-3">
                    <div class="row">
                        <div class="col">
                            <label for="class" class="form-label">Class</label>
                            <input type="text" id="class" name="class" required
                                class="form-control @error('class') border-danger @enderror" value="{{ $class->class }}">
                            @error('class')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="section" class="form-label">Section</label>
                            <select name="section" class="form-control" required>
                                <option>select section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            @error('section')
                                <p class="text-danger">{{ $message }}</p>
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
    </div>  
    
</x-layout>
