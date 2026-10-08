<x-layout>
    
    <div class="mx-auto max-w-screen-sm card p-6 bg-white rounded-md m-6">
        <h4 class="title">Create new account</h4>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4 flex flex-col">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') border-danger @enderror" value="{{ old("username") }}">
                @error("username")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 flex flex-col">
                <label class="form-label" for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') border-danger @enderror" value="{{ old("email") }}">
                @error("email")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 flex flex-col">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') border-danger @enderror">
                @error("password")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 flex flex-col">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') border-danger @enderror">
                @error("password_confirmation")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary">Register</button>
        </form>
    </div>

</x-layout>