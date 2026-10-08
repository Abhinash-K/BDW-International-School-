<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/dataTables.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script defer src="http://127.0.0.1:8000/assets/js/alpine.min.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/tagify.css">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

</head>

<body class="container-fluid">
    <div class="module-container">
        @auth
            @php
                $user = Auth::user();
            @endphp
            <div class="nav-container">
                <ul class="navbar-nav d-flex flex-column ">
                    @if($user->isAdmin())
                    <li><img src="http://127.0.0.1:8000/assets/img/bdw.png" alt="" width="100%"></li>

                    <ul>
                        <li> <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"> <i class="fa-solid fa-user-tie"></i> Admin Dashboard </a> </li>
                    </ul>
                    
                    <ul class="menu">
                        <li class="dropdown">
                            <a href="#" onclick="toggleDropdown(event)">
                                <i class="fas fa-tachometer-alt"></i> Users &nbsp; <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="submenu">
                                <li> <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}"> Teacher Users </a> </li>
                                <li> <a href="#">Admin</a> </li>
                                <li> <a href="#">Coordinators</a> </li>
                            </ul>
                        </li>
                    </ul>
                    
                    {{-- <li><a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li> --}}
                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('attachments.index') ? 'active' : '' }}" href="{{ route('attachments.index') }}">Media</a></li>
                    </ul>
                    
                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('classes.index') ? 'active' : '' }}" href="{{ route('classes.index') }}"> <i class="fa-solid fa-landmark"></i>  Class</a></li>
                    </ul>
                    
                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('academicyears.index') ? 'active' : '' }}" href="{{ route('academicyears.index') }}"> <i class="fa-solid fa-calendar-days"></i> Academic Years</a></li>
                    </ul>
                    
                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('subjects.index') ? 'active' : '' }}" href="{{ route('subjects.index') }}"> <i class="fa-solid fa-book"></i> Subjects</a></li>
                    </ul>

                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('lessonplans.index') ? 'active' : '' }}" href="{{ route('lessonplans.index') }}"> <i class="fa-solid fa-person-chalkboard"></i> Lesson Plans</a></li>
                    </ul>
                    
                    <ul>
                        <li><a class="nav-link {{ request()->routeIs('chapters.index') ? 'active' : '' }}" href="{{ route('chapters.index') }}"> <i class="fa-solid fa-person-chalkboard"></i> Chapters </a></li>
                    </ul>

                    @elseif ($user->isTeacher())
                    <li><a class="nav-link {{ request()->routeIs('teacherstasks.index') ? 'active' : '' }}"
                        href="{{ route('teacherstasks.index') }}">Tasks</a></li>
                    @endif
                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-flex col">
                                @csrf
                                <button class="btn btn-outline-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </ul>
            </div>
        @endauth
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- <script src="http://127.0.0.1:8000/assets/js/jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/popper.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/bootstrap.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/dataTables.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/tagify.min.js"></script> --}}
    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    @stack('scripts')

</body>

<script>
    function toggleDropdown(event) {
    event.preventDefault();

    // Get the parent <li> of the clicked <a>
    let parent = event.target.closest("li");

    // Close any open dropdowns
    document.querySelectorAll(".menu li.active").forEach(item => {
        if (item !== parent) {
            item.classList.remove("active");
        }
    });

    // Toggle the active class on the clicked menu item
    parent.classList.toggle("active");
}
</script>

</html>
