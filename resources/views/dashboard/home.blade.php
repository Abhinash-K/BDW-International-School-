<x-layout>
    <div class="page-wrapper"  style="position: absolute !important; top: 0px !important;">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ auth()->user()->username }}!</h3>
                        
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                
                                @if(Auth::check())
                                    @if(Auth::user()->role == 'teacher')
                                        <li class="breadcrumb-item active">Teacher</li>
                                    @else
                                        <li class="breadcrumb-item active">Admin</li>
                                    @endif
                                @else
                                    <li class="breadcrumb-item active">Principal</li>
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('teacher.change-password') }}" class="btn btn-warning">Change Password</a>
                                
            <!-- <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Classes</h6>
                                    <h3>04/06</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Students</h6>
                                    <h3>40/60</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Lessons</h6>
                                    <h3>30/50</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Hours</h6>
                                    <h3>15/20</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- @if($lessonPlans->count() > 0)
                <div class="table-responsive lesson">
                    <table class="table table-center">
                        <tbody>
                            @foreach ($lessonPlans as $plan)
                                <tr>
                                    <td>
                                        <div class="date">
                                            <b>{{ $plan->title }}</b>
                                            <ul class="teacher-date-list">
                                                <li><i class="fas fa-calendar-alt me-2"></i>{{ $plan->start_date }} - {{ $plan->end_date }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="lesson-completed">
                                            <p class="{{ $plan->status == 'Completed' ? 'text-success' : 'text-warning' }}">
                                                {{ $plan->status }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No lesson plans available.</p>
            @endif -->

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Students</h6>
                                    <h3>459</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Awards</h6>
                                    <h3>50+</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Teachers</h6>
                                    <h3>30+</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/professor_2321016_.png') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Events</h6>
                                    <h3>20</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/calendar_1968779_.png') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            @php
    $teacherId = auth()->user()->id;
@endphp
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-8">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-8 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                <h5 class="card-title">Chapters</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="chapterTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" href="#upcoming">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ongoing-tab" data-bs-toggle="tab" href="#ongoing">Ongoing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed">Completed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending">Pending</a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content pt-3 pb-3">
                        <!-- Upcoming Tab -->
                        <div class="tab-pane fade show active" id="upcoming">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody id="upcoming-lesson-plans-list">
                                        <!-- Upcoming lesson plans will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Ongoing Tab -->
                        <div class="tab-pane fade" id="ongoing">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody id="ongoing-lesson-plans-list">
                                        <!-- Ongoing lesson plans will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Completed Tab -->
                        <div class="tab-pane fade" id="completed">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody id="completed-lesson-plans-list">
                                        <!-- Completed lesson plans will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pending">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody id="pending-lesson-plans-list">
                                        <!-- Completed lesson plans will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- End Tab Content -->
                            </div>
                        </div>
                        
                        
                    <!-- <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <h5 class="card-title">CLASS XII | PHYSICS</h5>
                                </div>
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="50">
                                            <div class="progress-less">
                                                <b>55/60</b>
                                                <p>Lesson Progressed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <h5 class="card-title">CLASS XI | PHYSICS</h5>
                                </div>
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="50">
                                            <div class="progress-less">
                                                <b>50/60</b>
                                                <p>Lesson Progressed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <h5 class="card-title">CLASS X | PHYSICS</h5>
                                </div>
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="50">
                                            <div class="progress-less">
                                                <b>52/60</b>
                                                <p>Lesson Progressed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
    <h3 class="mb-4 text-left">Lesson Progress</h3>
    <div class="row d-flex flex-wrap justify-content-left">
        @foreach($progress as $data)
            @php
                $subjectName = $subjects[$data->subject_id] ?? 'Unknown Subject';
                $className = $classes[$data->class_id] ?? 'Unknown Class';
                $total = $data->total_lessons;
                $completed = $data->completed_lessons;
                $status = strtolower($data->status);

                $statusColors = [
                    'completed' => '#5D5FEF',
                    'ongoing'   => '#FFC107',
                    'pending'   => '#FF0000',
                    'upcoming'  => '#E0E0E0'
                ];

                $progressColor = $statusColors[$status] ?? '#E0E0E0';
                $chartId = "chart_{$data->subject_id}_{$data->class_id}";
            @endphp

            <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-4">
                <div class="card p-3 shadow-lg rounded-lg text-center" style="width: 250px">
                    <h5 class="font-weight-bold mb-2">{{ $className }} | {{ $subjectName }}</h5>

                    <div class="chart-container">
                    <canvas id="chart_{{ $data->subject_id }}_{{ $data->class_id }}"></canvas>
                        <div class="chart-label">
                        {{ round($completed / max($total, 1) * 100) }}%
                            <p class="text-muted mt-2 mb-0">Lesson Progressed</p>
                        </div>
                    </div>

                    <div class="chart-legend">
                        <div class="legend-item"><span class="legend-color completed"></span> Completed</div>
                        <div class="legend-item"><span class="legend-color ongoing"></span> Ongoing</div>
                        <div class="legend-item"><span class="legend-color pending"></span> Pending</div>
                        <div class="legend-item"><span class="legend-color upcoming"></span> Upcoming</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let chartData = @json($progress);
        let today = new Date();

        chartData.forEach(data => {
            let subjectId = data.subject_id;
            let classId = data.class_id;
            let totalLessons = parseInt(data.total_lessons);
            let completedLessons = parseInt(data.completed_lessons);
            let startDate = new Date(data.start_date);
            let endDate = new Date(data.end_date);

            // Default status color
            let progressColor = "#E0E0E0";

            if (completedLessons === totalLessons) {
                progressColor = "#5D5FEF"; // Completed (Blue)
            } else if (today >= startDate && today <= endDate) {
                progressColor = "#FFC107"; // Ongoing (Yellow)
            } else if (today < startDate) {
                progressColor = "#E0E0E0"; // Upcoming (Grey)
            } else if (today > endDate && completedLessons < totalLessons) {
                progressColor = "rgb(255, 0, 0)"; // Pending (Red)
            }

            let ctx = document.getElementById(`chart_${subjectId}_${classId}`);


            if (ctx) {
                new Chart(ctx.getContext("2d"), {
                    type: "doughnut",
                    data: {
                        datasets: [{
                            data: [completedLessons, totalLessons - completedLessons],
                            backgroundColor: [progressColor, "#E0E0E0"],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        cutout: "70%",
                        plugins: {
                            tooltip: { enabled: false },
                            legend: { display: false }
                        }
                    }
                });
            }
        });
    });
    
</script>


<style>
    .chart-container {
        position: relative;
        width: 200px;
        height: 200px;
        margin: auto;
    }

    .chart-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        font-weight: bold;
    }

    .chart-legend {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        font-size: 14px;
        font-weight: bold;
        margin-top: 10px;
        text-align: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        display: inline-block;
        border-radius: 50%;
    }

    .completed { background-color: #5D5FEF; }  /* Blue */
    .ongoing { background-color: #FFC107; }   /* Yellow */
    .pending { background-color: #FF0000; }   /* Red */
    .upcoming { background-color: #E0E0E0; }  /* Grey */

</style>

                </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-body">
                            <div id="calendar-doctor" class="calendar-container"></div>
                            <div class="calendar-info calendar-info1">
                                <div class="up-come-header">
                                    <h2>Upcoming Events</h2>
                                    <span><a href="javascript:;"><i class="feather-plus"></i></a></span>
                                </div>
                                <div class="upcome-event-date">
                                    <h3>5 Mar</h3>
                                    <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                </div>
                                
                                <div class="calendar-details">
                                    <!-- <p>08:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Regular Classes</h4>
                                            
                                        </div>
                                        <!-- <span>08:00 - 09:00 am</span> -->
                                    </div>
                                </div>
                                <div class="upcome-event-date">
                                    <h3>6 Mar</h3>
                                    <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                </div>
                                
                                <div class="calendar-details">
                                    <!-- <p>08:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Regular Classes</h4>
                                            
                                        </div>
                                        <!-- <span>08:00 - 09:00 am</span> -->
                                    </div>
                                </div>

                                <div class="upcome-event-date">
                                    <h3>12 Mar</h3>
                                    <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                </div>
                                
                                <div class="calendar-details">
                                    <!-- <p>08:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Regular Classes + NCERT TEST - 1</h4>
                                            
                                        </div>
                                        <!-- <span>08:00 - 09:00 am</span> -->
                                    </div>
                                </div>
                                <div class="upcome-event-date">
                                    <h3>14 Mar</h3>
                                    <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                </div>
                                
                                <div class="calendar-details">
                                    <!-- <p>08:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Holi</h4>
                                            <h5>A Hindu spring festival celebrated in February or March in honour of Krishna.</h5>
                                        </div>
                                        <!-- <span>08:00 - 09:00 am</span> -->
                                    </div>
                                </div>
                                <div class="calendar-details">
                                    <!-- <p>09:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Dolyatra</h4>
                                            <h5>A traditional Bengali festival</h5>
                                        </div>
                                        <!-- <span>09:00 - 10:00 am</span> -->
                                    </div>
                                </div>
                                <!-- <div class="calendar-details">
                                    <p>10:00 am</p>
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Botony</h4>
                                            <h5>Lorem ipsum sit amet</h5>
                                        </div>
                                        <span>10:00 - 11:00 am</span>
                                    </div>
                                </div> -->
                                <div class="upcome-event-date">
                                    <h3>28 Mar</h3>
                                    <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                </div>
                                <div class="calendar-details">
                                    <!-- <p>08:00 am</p> -->
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>Jamat UI-Vida</h4>
                                            <h5>Jamat UI-Vida, the last Friday of the holy month of Ramdan</h5>
                                        </div>
                                        <!-- <span>08:00 - 09:00 am</span> -->
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <!-- Top 10 Performers -->
                    <div class="col-xl-6 d-flex">
                        <div class="card flex-fill student-space comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Top 10 Performers - PHYSICS</h5>
                                <ul class="chart-list-out student-ellips">
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>

                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs" id="performersTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="class12-tab" data-bs-toggle="tab" href="#class12">Class XII</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="class11-tab" data-bs-toggle="tab" href="#class11">Class XI</a>
                                </li>
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tab-content p-3">
                                <!-- Class XII Tab -->
                                <div class="tab-pane fade show active" id="class12">
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th class="text-center">Marks</th>
                                                    <th class="text-center">Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>PRE2209</td><td>Alex</td><td class="text-center">98/100</td><td class="text-center">98%</td></tr>
                                                <tr><td>PRE1245</td><td>Jordan</td><td class="text-center">99/100</td><td class="text-center">99.5%</td></tr>
                                                <tr><td>PRE1625</td><td>Ryan</td><td class="text-center">99/100</td><td class="text-center">99.6%</td></tr>
                                                <tr><td>PRE2516</td><td>Liam</td><td class="text-center">98/100</td><td class="text-center">98.2%</td></tr>
                                                <tr><td>PRE2209</td><td>Noah</td><td class="text-center">98/100</td><td class="text-center">98%</td></tr>
                                                <tr><td>PRE3333</td><td>Ethan</td><td class="text-center">97/100</td><td class="text-center">97.5%</td></tr>
                                                <tr><td>PRE4444</td><td>Lucas</td><td class="text-center">97/100</td><td class="text-center">97.2%</td></tr>
                                                <tr><td>PRE5555</td><td>Daniel</td><td class="text-center">97/100</td><td class="text-center">97%</td></tr>
                                                <tr><td>PRE6666</td><td>Henry</td><td class="text-center">96/100</td><td class="text-center">96.8%</td></tr>
                                                <tr><td>PRE7777</td><td>Sebastian</td><td class="text-center">96/100</td><td class="text-center">96.5%</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Class XI Tab -->
                                <div class="tab-pane fade" id="class11">
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th class="text-center">Marks</th>
                                                    <th class="text-center">Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>PRE3333</td><td>Ethan</td><td class="text-center">97/100</td><td class="text-center">97.5%</td></tr>
                                                <tr><td>PRE4444</td><td>Lucas</td><td class="text-center">97/100</td><td class="text-center">97.2%</td></tr>
                                                <tr><td>PRE5555</td><td>Daniel</td><td class="text-center">97/100</td><td class="text-center">97%</td></tr>
                                                <tr><td>PRE6666</td><td>Henry</td><td class="text-center">96/100</td><td class="text-center">96.8%</td></tr>
                                                <tr><td>PRE7777</td><td>Sebastian</td><td class="text-center">96/100</td><td class="text-center">96.5%</td></tr>
                                                <tr><td>PRE2209</td><td>Alex</td><td class="text-center">98/100</td><td class="text-center">98%</td></tr>
                                                <tr><td>PRE1245</td><td>Jordan</td><td class="text-center">99/100</td><td class="text-center">99.5%</td></tr>
                                                <tr><td>PRE1625</td><td>Ryan</td><td class="text-center">99/100</td><td class="text-center">99.6%</td></tr>
                                                <tr><td>PRE2516</td><td>Liam</td><td class="text-center">98/100</td><td class="text-center">98.2%</td></tr>
                                                <tr><td>PRE2209</td><td>Noah</td><td class="text-center">98/100</td><td class="text-center">98%</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- End Tabs Content -->
                        </div>
                    </div>
                 
                     <!--Bottom 10 Performers - PHYSICS -->
                    <div class="col-xl-6 d-flex">
                        <div class="card flex-fill student-space comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Bottom 10 Performers - PHYSICS</h5>
                                <ul class="chart-list-out student-ellips">
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>

                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs" id="bottomPerformersTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="bottom-class12-tab" data-bs-toggle="tab" href="#bottom-class12">Class XII</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="bottom-class11-tab" data-bs-toggle="tab" href="#bottom-class11">Class XI</a>
                                </li>
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tab-content p-3">
                                <!-- Class XII Tab -->
                                <div class="tab-pane fade show active" id="bottom-class12">
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th class="text-center">Marks</th>
                                                    <th class="text-center">Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>PRE2209</td><td>Ethan</td><td class="text-center">50/100</td><td class="text-center">50%</td></tr>
                                                <tr><td>PRE1245</td><td>Oliver</td><td class="text-center">52/100</td><td class="text-center">52%</td></tr>
                                                <tr><td>PRE1625</td><td>Benjamin</td><td class="text-center">55/100</td><td class="text-center">55%</td></tr>
                                                <tr><td>PRE2516</td><td>Samuel</td><td class="text-center">58/100</td><td class="text-center">58%</td></tr>
                                                <tr><td>PRE2209</td><td>Nathan</td><td class="text-center">59/100</td><td class="text-center">59%</td></tr>
                                                <tr><td>PRE8888</td><td>Matthew</td><td class="text-center">60/100</td><td class="text-center">60%</td></tr>
                                                <tr><td>PRE9999</td><td>Jacob</td><td class="text-center">62/100</td><td class="text-center">62%</td></tr>
                                                <tr><td>PRE1010</td><td>Zachary</td><td class="text-center">64/100</td><td class="text-center">64%</td></tr>
                                                <tr><td>PRE1111</td><td>Adam</td><td class="text-center">65/100</td><td class="text-center">65%</td></tr>
                                                <tr><td>PRE1212</td><td>Thomas</td><td class="text-center">66/100</td><td class="text-center">66%</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Class XI Tab -->
                                <div class="tab-pane fade" id="bottom-class11">
                                    <div class="table-responsive">
                                        <table class="table star-student table-hover table-center table-borderless table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th class="text-center">Marks</th>
                                                    <th class="text-center">Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>PRE8888</td><td>Matthew</td><td class="text-center">60/100</td><td class="text-center">60%</td></tr>
                                                <tr><td>PRE9999</td><td>Jacob</td><td class="text-center">62/100</td><td class="text-center">62%</td></tr>
                                                <tr><td>PRE1010</td><td>Zachary</td><td class="text-center">64/100</td><td class="text-center">64%</td></tr>
                                                <tr><td>PRE1111</td><td>Adam</td><td class="text-center">65/100</td><td class="text-center">65%</td></tr>
                                                <tr><td>PRE1212</td><td>Thomas</td><td class="text-center">66/100</td><td class="text-center">66%</td></tr>
                                                <tr><td>PRE2209</td><td>Ethan</td><td class="text-center">50/100</td><td class="text-center">50%</td></tr>
                                                <tr><td>PRE1245</td><td>Oliver</td><td class="text-center">52/100</td><td class="text-center">52%</td></tr>
                                                <tr><td>PRE1625</td><td>Benjamin</td><td class="text-center">55/100</td><td class="text-center">55%</td></tr>
                                                <tr><td>PRE2516</td><td>Samuel</td><td class="text-center">58/100</td><td class="text-center">58%</td></tr>
                                                <tr><td>PRE2209</td><td>Nathan</td><td class="text-center">59/100</td><td class="text-center">59%</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- End Tabs Content -->
                        </div>
                    </div>

                <style>
                    .table-responsive {
                        max-height: 300px; /* Adjust height as needed */
                        overflow-y: auto;
                    }
                    .table thead {
                        position: sticky;
                        top: 0;
                        background: white;
                        z-index: 100;
                    }
                    .table-responsive.lesson {
                        max-height: 400px; /* Adjust height as needed */
                        overflow-y: auto;
                    }
                    .col-xl-8 {
                        flex: 1 0 auto !important;
                        width: 66.666667%;
                    }
                    .teacher-date-list li:last-child {
                        margin-left: 0px !important;
                    }
                    .calendar-info1 {
                        max-height: 400px; /* Adjust height as needed */
                        overflow-y: auto;
                        padding-bottom: 10px;
                        position: relative;
                    }

                    /* Keep the header fixed */
                    .up-come-header {
                        position: sticky;
                        top: 0;
                        background: white; /* Match the card background */
                        z-index: 100;
                        padding: 10px 0;
                    }

                    /* Move scroll start below the header */
                    .upcome-event-date:first-child {
                        margin-top: 10px; /* Creates space below header */
                    }


                </style>

            </div>
        </div>
    </div>
@section('script')
<script>
$(document).ready(function () {
    let chapterRoutines = {
        "2025-03-01": "Introduction to Algebra",
        "2025-03-02": "Basic Equations",
        "2025-03-03": "Quadratic Equations",
        "2025-03-04": "Polynomials",
        "2025-03-05": "Geometry Basics",
        "2025-03-06": "Triangles and Circles",
        "2025-03-07": "Probability Fundamentals",
        "2025-03-08": "Statistics Basics",
        "2025-03-09": "Linear Algebra",
        "2025-03-10": "Trigonometry Basics",
        "2025-03-11": "Advanced Trigonometry",
        "2025-03-12": "Differentiation",
        "2025-03-13": "Integration",
        "2025-03-14": "Calculus Applications",
        "2025-03-15": "Coordinate Geometry",
        "2025-03-16": "Vectors and Matrices",
        "2025-03-17": "Complex Numbers",
        "2025-03-18": "Logarithms",
        "2025-03-19": "Sequences and Series",
        "2025-03-20": "Combinatorics",
        "2025-03-21": "Graph Theory",
        "2025-03-22": "Set Theory",
        "2025-03-23": "Number Theory",
        "2025-03-24": "Probability Distributions",
        "2025-03-25": "Game Theory",
        "2025-03-26": "Differential Equations",
        "2025-03-27": "Topology",
        "2025-03-28": "Mathematical Induction",
        "2025-03-29": "Fourier Series",
        "2025-03-30": "Laplace Transforms",
        "2025-03-31": "Final Review and Q&A"
    };

    // Hook into existing .day click event
    $(document).on('click', '.day', function () {
        let selectedDate = $(this).data('date'); // Get selected date

        // Convert selected date to YYYY-MM-DD format
        let dateObj = new Date(selectedDate);
        let formattedDate = dateObj.getFullYear() + '-' + 
                            String(dateObj.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(dateObj.getDate()).padStart(2, '0');

        console.log("Clicked Date:", formattedDate); // Debugging Log

        let routine = chapterRoutines[formattedDate] || "No routine assigned for this day.";

        let eventContainer = $('.event-wrapper');

        // Remove previous chapter routine before adding a new one
        eventContainer.find('.chapter-routine').remove();

        // Append the routine only once
        eventContainer.append(`
            <div class="event chapter-routine">
                <div class="event-summary">Mathematics:  ${routine}</div>
            </div>
        `);
    });

    // Clear routine when closing the event container
    $(document).on('click', '.event-container .close', function () {
        $('.event-wrapper .chapter-routine').remove();
    });

    let allLessonPlans = []; // Store fetched data
const subjectMap = {};

// Fetch subjects and store in a map
fetch("/subjects-json")
    .then(response => response.json())
    .then(subjects => {
        subjects.forEach(sub => {
            subjectMap[sub.id] = sub.subject; // Ensure this matches the column name
        });

        console.log("Subjects Map:", subjectMap); // Debugging
    })
    .catch(error => console.error("Error fetching subjects:", error));

// Fetch lesson plans and store them
fetch('/lesson-plans-json')
    .then(response => response.json())
    .then(data => {
        console.log("Lesson Plans Data:", data); // Debugging

        allLessonPlans = data; // ✅ Store the lesson plans globally
        displayLessonPlans("Upcoming"); // ✅ Auto-display "Upcoming" lesson plans
    })
    .catch(error => console.error("Error fetching lesson plans:", error));

// Function to display lesson plans based on status
function displayLessonPlans(status) {
    let lessonPlansListId = "";

    if (status === "Upcoming") {
        lessonPlansListId = "upcoming-lesson-plans-list";
    } else if (status === "Ongoing") {
        lessonPlansListId = "ongoing-lesson-plans-list";
    } else if (status === "Completed") {
        lessonPlansListId = "completed-lesson-plans-list";
    } else if (status === "Pending") {
        lessonPlansListId = "pending-lesson-plans-list";
    }

    let lessonPlansList = document.getElementById(lessonPlansListId);
    lessonPlansList.innerHTML = "";

    let today = new Date().toISOString().split("T")[0];

    let filteredPlans = allLessonPlans.filter(plan => {
        let startDate = new Date(plan.start_date).toISOString().split("T")[0];
        let endDate = new Date(plan.end_date).toISOString().split("T")[0];

        if (status === "Upcoming") {
            return startDate > today;
        } else if (status === "Ongoing") {
            return startDate <= today && endDate >= today;
        } else if (status === "Completed") {
            return plan.status === "Completed";
        } else if (status === "Pending") {
            return endDate < today && plan.status !== "Completed";
        }
    });

    if (filteredPlans.length > 0) {
        filteredPlans.forEach(plan => {
            // ✅ Use `plan.subject` directly instead of subjectMap[plan.subject_id]
            let subjectName = plan.subject || "Unknown Subject";

            console.log(`Lesson: ${plan.title}, Subject: ${subjectName}`);

            let row = `
                <tr>
                    <td>
                        <div class="date">
                            <b>${plan.title}</b>
                            <p class="mt-1"><i class="fas fa-book me-2"></i>${subjectName}</p>
                            <ul class="teacher-date-list">
                                <li><i class="fas fa-calendar-alt me-2"></i>${plan.start_date} - ${plan.end_date}</li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <div class="lesson-completed"></div>
                    </td>
                </tr>
            `;
            lessonPlansList.innerHTML += row;
        });
    } else {
        lessonPlansList.innerHTML = `<tr><td colspan="2">No lesson plans available.</td></tr>`;
    }
}

        // Add event listeners for tab clicks
        document.querySelectorAll(".nav-link").forEach(tab => {
            tab.addEventListener("click", function () {
                let status = this.innerText.trim(); // Get status from tab text
                displayLessonPlans(status);
            });
        });


        });
  </script>
  <!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/lesson-progress')
        .then(response => response.json())
        .then(data => {
            let progressContainer = document.getElementById('progress-container');
            progressContainer.innerHTML = ''; // Clear existing content
            
            data.forEach(item => {
                let percent = Math.round((item.completed_lessons / item.total_lessons) * 100);
                let html = `
                    <div class="col-12 col-md-4 d-flex">
                        <div class="card flex-fill comman-shadow">
                            <div class="card-header">
                                <h5 class="card-title">CLASS ${item.class.class} | ${item.subject.subject}</h5>
                            </div>
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="${percent}">
                                        <div class="progress-less">
                                            <b>${item.completed_lessons}/${item.total_lessons}</b>
                                            <p>Lesson Progressed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                
                progressContainer.innerHTML += html;
            });
        })
        .catch(error => console.error("Error fetching data:", error));
});
</script>

<div class="row" id="progress-container"></div> -->

@endsection
    

<table class="table table-center">
    <tbody id="lesson-container">
        <!-- JSON Data will be inserted here -->
    </tbody>
</table>

</x-layout>



