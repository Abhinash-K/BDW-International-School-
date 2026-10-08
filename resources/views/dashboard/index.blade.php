<x-layout>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            {{-- <h3 class="page-title">Welcome {{ Session::get('name') }}!</h3> --}}
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item active">{{ Session::get('name') }}</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Users</h5>
                        <h1>{{ $users }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Teachers</h5>
                        <h1>{{ $teachers }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Coordinators</h5>
                        <h1>{{ $coordinators }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="classLessons">
                </canvas>
            </div>
            <div class="col">
                <canvas id="teachersTasks">
                </canvas>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="subjectLessons">
                </canvas>
            </div>

            <div class="col">
                <canvas id="chapterLessons"></canvas>
            </div>
            {{-- <div class="col">
                <canvas id="teachersTasks">
                </canvas>
            </div> --}}
        </div>
    </div>
</div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
        <script>
            (async function() {
                const data = @json($lessonPlans);

                new Chart(
                    document.getElementById('classLessons'), {
                        type: 'bar',
                        data: {
                            labels: data.map(row => row.class),
                            datasets: [{
                                label: 'Lessons by class',
                                data: data.map(row => row.total)
                            }]
                        }
                    }
                );
            })();
            (async function() {
                const data = @json($teacherslessonPlans);

                new Chart(
                    document.getElementById('teachersTasks'), {
                        type: 'bar',
                        data: {
                            labels: data.map(row => row.teacher),
                            datasets: [{
                                label: 'Lessons by Teachers',
                                data: data.map(row => row.total)
                            }]
                        }
                    }
                );
            })();
            (async function() {
                const data = @json($subjectlessonPlans);

                new Chart(
                    document.getElementById('subjectLessons'), {
                        type: 'bar',
                        data: {
                            labels: data.map(row => row.subject),
                            datasets: [{
                                label: 'Lessons by Subject',
                                data: data.map(row => row.total)
                            }]
                        }
                    }
                );
            })();

            (async function() {
                const data = @json($chapterlessonPlans);
                new Chart(document.getElementById('chapterLessons'), {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.chapter),
                        datasets: [{
                            label: 'Lessons by Chapter',
                            data: data.map(row => row.total)
                        }]
                    }
                });
            })();
        </script>
    @endpush
</x-layout>
