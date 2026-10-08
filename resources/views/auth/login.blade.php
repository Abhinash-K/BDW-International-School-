<x-layout>
    <div class="container d-flex justify-content-center align-items-center flex-column bg-info bg-gradient" style="height:100vh;width:100vw;">
        <img src="http://127.0.0.1:8000/assets/img/bdw.png" alt="" width="20%">
        <form action="{{ route('login') }}" method="POST" class="form-floating d-flex flex-column gap-1">
            @csrf
            <div class="row">
                <img src="http://127.0.0.1:8000/assets/img/bdw.png" alt="" width="100%">
            </div>
            <div class="row">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control @error('email') border-danger @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') border-danger @enderror">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
            </div>
            <div class="row">
                @error('failed')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <button class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
   
</x-layout>
