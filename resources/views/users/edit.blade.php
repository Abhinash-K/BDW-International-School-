<x-layout>
    <div class="page-wrapper" style="position: absolute !important; top: 0px !important; width: 80%;">
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="">Update User</h2>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
        </div>
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-success" />
        @elseif(session('failed'))
            <x-flashMsg msg="{{ session('failed') }}" bg="bg-danger" />
        @endif
        <form action="{{ route('users.update',$user) }}" method="POST" class="form-floating">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column gap-3">
                <div class="row">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" required
                            class="form-control @error('username') border-danger @enderror"
                            value="{{ $user->username }}">
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" required
                            class="form-control @error('email') border-danger @enderror"
                            value="{{ $user->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                @php
                                $role = [
                                    '1' => 'Coordinator',
                                    '2' => 'Teacher',
                                ];
                                @endphp
                                @foreach ($role as $value => $label)
                                    <option value="{{ $value }}" {{ $user->role == $value ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        @error('role')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" required
                            class="form-control @error('password') border-danger @enderror"
                            value="">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col p-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</x-layout>