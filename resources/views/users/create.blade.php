<x-layout>
    <div class="page-wrapper">
    <div class="container">
        <div class="content container-fluid">
            <div class="d-flex flex-row justify-content-between">
                <h3 class="">Add User</h3>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>

            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
            @elseif(session('failed'))
                <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="form-floating">
                @csrf
                <div class="d-flex flex-column gap-3">
                    <div class="row">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" required
                                class="form-control @error('username') border-danger @enderror">
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" required
                                class="form-control @error('email') border-danger @enderror">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option> <!-- Default blank option -->
                                <option value="1">Coordinator</option>
                                <option value="2">Teacher</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" required
                                class="form-control @error('password') border-danger @enderror">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
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
    </div>
</x-layout>


{{-- <x-layout>
    <div class="container">
        <div class="content container-fluid">
            <div class="d-flex flex-row justify-content-between">
                <h3 class="">Add User</h3>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
            @elseif(session('failed'))
                <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
            @endif
            <form action="{{ route('users.store') }}" method="POST" class="form-floating">
                @csrf
                <div class="d-flex flex-column gap-3">
                    <div class="row">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" required
                                class="form-control @error('username') border-danger @enderror"
                                value="{{ old('username') }}">
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" required
                                class="form-control @error('email') border-danger @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="1">Coordinator</option>
                                    <option value="2">Teacher</option>
                                </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" required
                                class="form-control @error('password') border-danger @enderror"
                                value="{{ old('password') }}">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
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
</x-layout> --}}