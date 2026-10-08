<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

    
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/css/tagify.css">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">

</head>
<body>
    @auth
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="{{ route('dashboard') }}" class="logo">
                        <img src="{{ URL::to('assets/img/logo.png') }}" alt="Logo">
                    </a>
                    <a href="{{ route('dashboard') }}" class="logo logo-small">
                        <img src="{{ URL::to('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                    </a>
                </div>
                <div class="menu-toggle">
                    <a href="javascript:void(0);" id="toggle_btn">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
    
                <div class="top-nav-search">
                    <form>
                        <input type="text" class="form-control" placeholder="Search here">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <a class="mobile_btn" id="mobile_btn">
                    <i class="fas fa-bars"></i>
                </a>
                <ul class="nav user-menu">
                    <li class="nav-item zoom-screen me-2">
                        <a href="#" class="nav-link header-nav-list win-maximize">
                            <img src="{{ URL::to('assets/img/icons/header-icon-04.svg') }}" alt="">
                        </a>
                    </li>
    
                    <li class="nav-item dropdown has-arrow new-user-menus">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                {{-- <img class="rounded-circle" src="/images/{{ Session::get('avatar') }}" width="31"alt=""> --}}
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                                </div>
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    {{-- <img src="/images/{{ Session::get('avatar') }}" alt="" class="avatar-img rounded-circle"> --}}
                                </div>
                                <div class="user-text">
                                    <h6>{{ Session::get('name') }}</h6>
                                    <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="#">My Profile</a>
                            <a class="dropdown-item" href="inbox.html">Inbox</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                            
                        </div>
                    </li>
                </ul>
            </div>
            {{-- side bar --}}
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">
                                <span>Main Menu</span>
                            </li>            
                            {{-- <li class="submenu ">
                                <a>
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span> Dashboard</span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('dashboard') }}" class="">Admin Dashboard</a></li>
                                    <li><<li><a href="{{ route('dashboard') }}" class="">Teacher Dashboard</a></li>
                                    <li><a href="" class="">Student Dashboard</a></li>
                                </ul>
                            </li> --}}
                            <li class="submenu {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="#"><i class="fas fa-chalkboard"></i>
                                    <span> Dashboard</span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->routeIs('home') ? 'active' : '' }}" 
                                           href="{{ route('home') }}">
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('users') ? 'active' : '' }}" 
                                           href="{{ route('users.index') }}">
                                            Users
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('create') ? 'active' : '' }}" 
                                           href="{{ route('users.create') }}">
                                            Add Users
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            
                            {{-- @if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
                            <li class="submenu ">
                                <a href="#">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>User Management</span> 
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="" class="">List Users</a></li>
                                </ul>
                            </li>
                            @endif --}}
            
                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-graduation-cap"></i>
                                    <span> Students</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href=""  class="">Student List</a></li>
                                    <li><a href="" class="">Student Add</a></li>
                                    <li><a class="">Student Edit</a></li>
                                    <li><a href=""  class="">Student View</a></li>
                                </ul>
                            </li>
            
                            <li class="submenu  ">
                                <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                                    <span> Teachers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="" class="">Teacher List</a></li>
                                    <li><a href="teacher-details.html">Teacher View</a></li>
                                    <li><a href="" class="">Teacher Add</a></li>
                                    <li><a class="">Teacher Edit</a></li>
                                </ul>
                            </li> --}}
            
                            <li class="submenu ">
                                <a href="#"><i class="fas fa-school"></i>
                                    <span> Classes</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a class="{{ request()->routeIs('classes.index') ? 'active' : '' }}" 
                                        href="{{ route('classes.index') }}">
                                         Class list
                                     </a></li>
                                    <li><a class="{{ request()->routeIs('classes.create') ? 'active' : '' }}" 
                                        href="{{ route('classes.create') }}">
                                         Class Add
                                     </a></li>
                                </ul>
                            </li>
                            
            
                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-building"></i>
                                    <span> Departments</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="" class="">Department List</a></li>
                                    <li><a href="" class="">Department Add</a></li>
                                    <li><a>Department Edit</a></li>
                                </ul> --}}
                            </li>
    
                            <li class="submenu">
                                <a href="#"><i class="fas fa-book-reader"></i>
                                    <span> Subjects</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('subjects.index') }}">Subject List</a></li>
                                    <li><a href="{{ route('subjects.create') }}">Add Subject</a></li>
                                </ul>
                            </li>
                            
                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-book-reader"></i>
                                    <span> Subjects</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a class="">Subject List</a></li>
                                    <li><a class="">Subject Add</a></li>
                                    <li><a>Subject Edit</a></li>
                                </ul>
                            </li> --}}
                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-book"></i>
                                    <span> Chapters</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a class="">Chapter List</a></li>
                                    <li><a class="">Chapter Add</a></li>
                                    <li><a>Chapter Edit</a></li>
                                </ul>
                            </li> --}}
    
                            <li class="submenu {{ request()->routeIs('lessonplans.index', 'lessonplans.create') || request()->is('lessonplans/edit/*') ? 'active' : '' }}">
                                <a href="#"><i class='fas fa-chalkboard-teacher'></i>
                                    <span> Chapters </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->routeIs('lessonplans.index') || request()->is('lessonplans/edit/*') ? 'active' : '' }}" 
                                           href="{{ route('lessonplans.index') }}">
                                           Chapters List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('lessonplans.create') ? 'active' : '' }}" 
                                           href="{{ route('lessonplans.create') }}">
                                            Add Chapters
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="submenu {{ request()->routeIs('examinations.index', 'examinations.create') || request()->is('examinations/edit/*') ? 'active' : '' }}">
                                <a href="#"><i class='fas fa-chalkboard-teacher'></i>
                                    <span> Examination </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->routeIs('examinations.index') || request()->is('examinations/edit/*') ? 'active' : '' }}" 
                                           href="{{ route('examinations.index') }}">
                                           Examination List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('examinations.create') ? 'active' : '' }}" 
                                           href="{{ route('examinations.create') }}">
                                            Add Examination
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="submenu ">
                                <a href="#">
                                    <span><i class='fas fa-chalkboard-teacher'></i> Routines</span>
                                    <span class="menu-arrow"></span> <!-- Arrow for submenu -->
                                </a>
                                <ul>
                                    <li>
                                        <a href="https://bdwinternationalschool.com/bdw-schedule/" target="_blank">
                                            <i class="fas fa-external-link-alt"></i> View Routine
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            

                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-book"></i>
                                    <span> Lesson Plan</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a class="">Lesson Plan List</a></li>
                                    <li><a class="">Lesson Plan Add</a></li>
                                    <li><a>Chapter Edit</a></li>
                                </ul>
                            </li> --}}
                            {{-- <li class="submenu ">
                                <a href="#"><i class="fas fa-cog"></i>
                                    <span> Settings</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="#"  class="">General Settings</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            {{-- content page --}}
            @yield('content')
            <footer>
                <p>Copyright ©  <?php echo date('Y'); ?> InTown Solutions</p>
            </footer>
        
        </div>
    @endauth
    {{-- <main> --}}
        {{ $slot }}
    {{-- </main> --}}

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ URL::to('assets/js/calander.js') }}"></script>
    <script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <script src="http://127.0.0.1:8000/assets/js/tagify.min.js"></script>
    @yield('script')
    @stack('scripts')
    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>
</body>
</html>