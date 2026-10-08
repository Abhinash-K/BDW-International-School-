<!-- classes -->
<x-layout>
    <div class="page-wrapper" style="position: absolute !important; top: 0px !important; width: 1200px;">
        <div class="content container-fluid" style="width: 100%;">
            <div class="d-flex flex-row justify-content-between">
                <h3 class="">Add a class</h3>
                <a href="{{ route('classes.index') }}" class="btn btn-primary">Back</a>
            </div>
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
            @elseif(session('failed'))
                <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
            @endif
            <form action="{{ route('classes.store') }}" method="POST" class="form-floating">
                @csrf
                <div class="d-flex flex-column gap-3">
                    <div class="row">
                        <div class="col">
                            <label for="class" class="form-label">Class</label>
                            <input type="text" id="class" name="class" required
                                class="form-control @error('class') border-danger @enderror" value="{{ old('class') }}">
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
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
      
</x-layout>

{{-- <x-layout>
   @section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add a Class</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                            <li class="breadcrumb-item active">Add Class</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
            @elseif(session('failed'))
                <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('classes.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Class Information</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('class') border-danger @enderror" id="class" name="class" value="{{ old('class') }}" required>
                                            @error('class')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Section <span class="login-danger">*</span></label>
                                            <select class="form-control" name="section" required>
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

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-layout> --}}
