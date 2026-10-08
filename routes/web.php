<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Users;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\AcademicYearsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LessonPlansController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\TeachersTasks;
use App\Http\Controllers\Attachments;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherAssignmentController;
use App\Http\Controllers\TeachersDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\StudentImportController;
use App\Http\Controllers\TestImportController;
use App\Models\LessonPlan;
use App\Http\Middleware\UserAccess;
use App\Http\Controllers\TeacherController;

Route::get('/test-import', function () {
    return response()->json(['message' => 'Route is working!']);
});


// Route::get('/dashboard', function () {
//     $lessonPlans = LessonPlan::all(); // Fetch lesson plans from DB
//     return view('home', compact('lessonPlans'));
// });



Route::get('/home', function () {
    $lessonPlans = LessonPlan::all();
    return view('dashboard.home',compact('lessonPlans'));
})->name('home');


// Route::get('/home', function () {
//     $lessonPlans = LessonPlan::all(); // Fetch all lesson plans
//     return view('home', ['lessonPlans' => $lessonPlans->toJson()]); // Convert to JSON
// });

// Route::get('/lesson-plans-json', function () {
//     return response()->json(LessonPlan::all());
// });
Route::get('/lesson-plans-json', function () {
    return response()->json(
        LessonPlan::where('teacher_id', Auth::id())->get()
    );
});

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/dashboard', [Dashboard::class,'index'])->name("dashboard");

    Route::resource('teacherstasks',TeachersTasks::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
});
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/change-password', [TeacherController::class, 'showChangePasswordForm'])->name('teacher.change-password');
    Route::post('/teacher/change-password', [TeacherController::class, 'updatePassword'])->name('teacher.update-password');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::view('/register', 'auth.register')->name("register");
    Route::post('/register', [AuthController::class, 'register']);

    Route::resource('users',Users::class);
    Route::get('/getUsers', [Users::class, 'getUsers'])->name('getUsers');
    
    
    Route::resource('classes',ClassesController::class);
    Route::get('/getClasses', [ClassesController::class, 'getClasses'])->name('getClasses');
    
    Route::resource('academicyears',AcademicYearsController::class);
    Route::get('/getAcademicyear', [AcademicYearsController::class, 'getAcademicyear'])->name('getAcademicyear');
    
    Route::resource('subjects', SubjectController::class);
    Route::get('/getSubjexct', [SubjectController::class, 'getSubject'])->name('getSubject');
    //Route::post('/subjects/import', [SubjectController::class, 'importSubjects'])->name('subjects.import');
    
    Route::get('/lesson-progress', [LessonPlansController::class, 'showLessonProgress'])->name('lesson.progress');
    Route::resource('lessonplans',LessonPlansController::class);
    Route::get('/getLessonplans', [LessonPlansController::class, 'getLessonplans'])->name('getLessonplans');
    Route::get('/lessonplans/details/{id}', [LessonPlansController::class, 'getLessonPlanDetails']);
    Route::get('/lessonplans/status/{id}', [LessonPlansController::class, 'getStatus'])->name('lessonplans.status'); //status modal
    // Route::get('/lessonplans', 'LessonPlansController@getLessonPlans')->name('getLessonplans');
    // Route::get('/lessonplans/status/{id}', 'LessonPlansController@getStatus');
    Route::post('/lessonplans/status/update/{id}', [LessonPlansController::class, 'updateStatus'])->name('lesTwins');
    // Route::delete('/lessonplans/{id}', 'LessonPlansController@destroy');
    Route::get('/get-assigned-classes', [LessonPlansController::class, 'getAssignedClasses'])->name('get.assigned.classes');
    // filter by subject
    Route::get('/get-subjects', [LessonPlansController::class, 'getSubjects'])->name('getSubjects');
    Route::get('/getTeacherSubjects', [LessonPlansController::class, 'getTeacherSubjects'])->name('getTeacherSubjects');
    Route::post('/lessonplans/update-status', [LessonPlansController::class, 'updateStatus'])->name('updateLessonPlanStatus');

    Route::get('/lessonplans/fetch', [HomeController::class, 'index'])->name('lessonplans.fetch');

    // Route::get('/lesson-plans-json', function () {
    //     $lessonPlans = LessonPlan::all()->map(function ($plan) {
    //         return [
    //             'title' => $plan->title,
    //                 'start_date' => \Carbon\Carbon::parse($plan->start_date)->format('F j, Y'),
    //                 'end_date' => \Carbon\Carbon::parse($plan->end_date)->format('F j, Y'),
    //                 'status' => $plan->status,
    //             ];
    //         });
        
    //         return response()->json($lessonPlans);
    //     });
    Route::get('/lesson-plans-json', function () {
        return response()->json(
            LessonPlan::where('teacher_id', Auth::id())->get()->map(function ($plan) {
                return [
                    'title'      => $plan->title,
                    'start_date' => \Carbon\Carbon::parse($plan->start_date)->format('F j, Y'),
                    'end_date'   => \Carbon\Carbon::parse($plan->end_date)->format('F j, Y'),
                    'status'     => $plan->status,
                    'subject' => optional($plan->subject)->subject ?? 'Unknown', // Handles null subjects
                ];
            })
        );
    });


    Route::post('/update-lessonplan-status', [LessonPlansController::class, 'updateStatus'])->name('updateLessonPlanStatus');
    Route::get('/home', [LessonPlansController::class, 'showLessonProgress'])->name('home');


    Route::middleware(['auth', UserAccess::class . ':teacher'])->get('/test-middleware', function () {
        return "Middleware is working!";
    });
    
    
    Route::post('/upload_image', [FileUploadController::class, 'uploadImage']);
    Route::post('/upload_file', [FileUploadController::class, 'uploadFile']);
    Route::get('/fetchClasses', [LessonPlansController::class, 'fetchClasses']);
    Route::get('/fetchTechers', [LessonPlansController::class, 'fetchTechers']);
    Route::get('/fetchSubjects', [LessonPlansController::class, 'fetchSubjects']);

    // Route::prefix('subject')->group(function () {
    //     Route::get('list/page', [LessonPlansController::class, 'index'])->name('subject/list/page');
    //     Route::get('add/page', [LessonPlansController::class, 'create'])->name('subject/add/page');
    //     Route::get('edit/{id}', [LessonPlansController::class, 'edit'])->name('subject/edit');
    // });

    // <----------------------------------Chapter---------------------------------------------------->
    // Route::get('/chapters/create', [ChapterController::class, 'create'])->name('chapters.create');
    // Route::post('/chapters/store', [ChapterController::class, 'store'])->name('chapters.store');
    // Route::post('/chapters/delete', [ChapterController::class, 'delete'])->name('chapters.delete');
    // Route::get('chapters/{chapter}/edit', [ChaptersController::class, 'edit'])->name('chapters.edit');
    
    // Route::get('chapter/list/page', 'index')->middleware('auth')->name('chapter.list'); // lessonplan list
    // Route::get('chapter/add/page', 'create')->middleware('auth')->name('chapter.add'); // add lessonplan
    // Route::post('chapter/save', 'store')->name('chapter.save'); // save lessonplan
    // Route::post('chapter/update', 'update')->name('chapter.update'); // update lessonplan
    // Route::post('chapter/delete', 'destroy')->name('chapter.delete'); // delete lessonplan
    // Route::get('chapter/edit/{id}', 'edit')->name('chapter.edit'); // edit lessonplan
    //         Route::controller(ChapterController::class)->group(function () {
        //     });

        //-------------calendars routes----------------
        Route::get('/calendars', [CalendarController::class, 'index'])->name('calendars.index');
        Route::get('/calendars/create', [CalendarController::class, 'create'])->name('calendars.create');
        Route::post('/calendars', [CalendarController::class, 'store'])->name('calendars.store');

        //-------------examinations routes----------------
        Route::get('/examinations', [ExaminationController::class, 'index'])->name('examinations.index');
        Route::get('/examinations/create', [ExaminationController::class, 'create'])->name('examinations.create');
        //Route::post('/examinations', [ExaminationController::class, 'store'])->name('examinations.store');
        Route::get('/examinations/schedule/{class_id}', [ExaminationController::class, 'schedule'])->name('examinations.schedule');
        Route::post('/examinations/store', [ExaminationController::class, 'store'])->name('examinations.store');
        //Route::get('/get-exam-types-by-class', [ExaminationController::class, 'getExamTypesByClass'])->name('getExamTypesByClass');
        Route::resource('examinations', ExaminationController::class);
        //Route::delete('/examinations/deleteAll', [ExaminationController::class, 'deleteAll'])->name('examinations.deleteAll');
        Route::delete('/examinations/delete-all', [ExaminationController::class, 'deleteAll'])->name('examinations.deleteAll');

        //-------------events routes----------------
        Route::resource('events', EventController::class);

        //------------sections routes---------------
        Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/sections/{class_id}', [SectionController::class, 'getSections']);
        Route::get('/get-sections/{class_id}', [SectionController::class, 'getSections']);
        Route::get('/sections-by-class/{class_id}', [SectionController::class, 'getSectionsByClass']);
        
        Route::middleware(['auth'])->group(function () {
            Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters.index'); // List all chapters
            Route::get('/chapters/create', [ChapterController::class, 'create'])->name('chapters.create'); // Show create form
            // Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store'); // Store new chapter
            // Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show'); // View a single chapter
            // Route::get('/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapters.edit'); // Edit form
            //Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapters.update'); // Update chapter
            //Route::delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy'); // Delete chapter
        Route::get('/get-sections/{classId}', [SectionController::class, 'getSections']);

        });
        Route::middleware(['auth'])->group(function () {
            Route::get('/teacher/dashboard', [TeachersDashboardController::class, 'index'])->name('teacher.dashboard');
        });
        //---------------------STUDENTS-------------
        Route::resource('students', StudentController::class);
        Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::get('students/{id}/assign-subjects', [StudentController::class, 'showAssignSubjects'])->name('students.showAssignSubjects');
        Route::post('students/{id}/assign-subjects', [StudentController::class, 'assignSubjects'])->name('students.assignSubjects');
        
        // Route::get('/students/import', function(){
        //     return view('students.import');
        // })->name('students.import.form');
        // Route::post('/students/import', [StudentImportController::class, 'import'])->name('students.import');
        Route::post('/students/import', [StudentImportController::class, 'import'])->name('students.import');
        Route::get('/upload', [UploadController::class, 'showUploadForm'])->name('upload.show');
        Route::post('/upload/import', [UploadController::class, 'import'])->name('upload.import');
        

        Route::middleware(['auth'])->group(function () {
            Route::get('/teacher-assignments', [TeacherAssignmentController::class, 'index'])->name('teacher_assignments.index');
            Route::get('/teacher-assignments/create', [TeacherAssignmentController::class, 'create'])->name('teacher_assignments.create');
            Route::post('/teacher-assignments', [TeacherAssignmentController::class, 'store'])->name('teacher_assignments.store');
        });

        
        Route::get('/teachers/dashboard', [TeachersDashboardController::class, 'index'])
            ->middleware(['auth', 'user-access:2'])
            ->name('teachers.dashboard');


        Route::middleware(['auth'])->group(function () {
            Route::get('/dashboard', function () {
                if (Auth::check() && Auth::user()->role == 2) {
                    return redirect()->route('teachers.dashboard'); // Redirect teachers
                }
                return view('dashboard'); // Admin stays on the same page
            })->name('dashboard');

            // Route::middleware(['teacher'])->group(function () {
            //     Route::get('/teachers/dashboard', [TeachersDashboardController::class, 'index'])
            //         ->name('teachers.dashboard');
            // });

        Route::middleware(['auth', 'user-access:2'])->group(function () {
            Route::get('/teachers/dashboard', [TeachersDashboardController::class, 'index'])
                ->name('teachers.dashboard');
        });
        //-----------------exam results-------------
        Route::get('/exam-results', [ExamResultController::class, 'index'])->name('exam-results.index');
        Route::post('/exam-results/fetch', [ExamResultController::class, 'fetchStudents'])->name('exam-results.fetch');
        Route::post('/exam-results/store', [ExamResultController::class, 'store'])->name('exam-results.store');
        Route::post('/exam-results/fetch-students-subjects', [ExamResultController::class, 'fetchStudentsSubjects'])->name('exam-results.fetch-students-subjects');
        Route::match(['GET', 'POST'], '/exam-results/fetch', [ExamResultController::class, 'fetchStudents'])->name('exam-results.fetch');

        Route::get('/subjects/by-class/{class_id}', [SubjectController::class, 'getSubjectsByClass']);
        Route::get('/assign-subjects', [ExaminationController::class, 'assignSubjects']);

        Route::get('/import', function () {
            return view('import');
        });
        Route::post('/import', [ImportController::class, 'import'])->name('import.excel');
       
        // Route::post('/subjects/import', function () {
        //     dd('Route is working!');
        // })->name('subjects.import');
        
        // Route::get('/test-import', [TestImportController::class, 'test']);
        Route::get('/test', function () {
            return "Route is working!";
        });

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        //Route::post('/student/upload', [StudentController::class, 'uploadStudents'])->name('student.upload');
        Route::post('/students/upload', [StudentController::class, 'uploadStudents'])->name('students.upload');
    });

        
        
    });


Route::view('/login', 'auth.login')->name("login");
Route::post('/login', [AuthController::class, 'login']);

Route::post('/subjects/import', [SubjectController::class, 'importSubjects'])->name('subjects.import');