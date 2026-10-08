<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonPlan;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\AcademicYears;
use App\Http\Requests\LessonPlansRequest;
// use App\DataTables\LessonPlansDataTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;
// use App\Models\Status;

/**
 * Lesson Plans
 */
class LessonPlansController extends Controller
{
    /**
     * Render Lesson Plans List
     *
     * @param LessonPlansDataTable $datatable
     * @return void
     */
    // public function index(LessonPlansDataTable $datatable){
    //     return $datatable->render("lessonplans.index");
    // }
    // public function index() {
    //     $lessonplan = LessonPlan::all();
    //     return view('lessonplans.index');
    // }

    public function index(Request $request)
    {
        $upcomingLessons = LessonPlan::where('status', 'Upcoming')
            ->where('start_date', '>=', now()) // Ensure lessons are in the future
            ->with(['subject']) // Load subject relationships if needed
            ->orderBy('start_date', 'asc')
            ->get();
        return view('lessonplans.index', compact('upcomingLessons'));
    }


//--------------------------------filter by tecaher subject-------------------------------- 

    // public function getTeacherSubjects()
    // {
    //     $teacherId = auth()->id(); // Get logged-in teacher's ID
    //     $subjects = LessonPlan::where('teacher_id', $teacherId)
    //                 ->with('subject') // Ensure the subject relationship is loaded
    //                 ->get()
    //                 ->map(function ($lessonPlan) {
    //                     return [
    //                         'id' => $lessonPlan->subject->id ?? null, 
    //                         'name' => $lessonPlan->subject->subject ?? 'Undefined'
    //                     ];
    //                 })
    //                 ->unique('id')
    //                 ->values();

    //     return response()->json($subjects);
    // }
    public function getTeacherSubjects()
{
    $teacherId = auth()->id();

    if (!$teacherId) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $subjects = LessonPlan::where('teacher_id', $teacherId)
        ->with('subject')
        ->get()
        ->map(function ($lessonPlan) {
            return [
                'id' => $lessonPlan->subject->id ?? null,
                'name' => $lessonPlan->subject->subject ?? 'Undefined'
            ];
        })
        ->unique('id')
        ->values();

    return response()->json($subjects);
}
       // ---------------------------------------------------------------------------------------------

    


public function getAssignedClasses()
    {
        $teacherId = auth()->id(); // Get logged-in teacher ID

        // Debugging: Check if the teacher ID is retrieved
        if (!$teacherId) {
            return response()->json(['error' => 'No teacher logged in'], 400);
        }

        // Debugging: Check if teacher_class_assignments has records for this teacher
        $assignments = DB::table('teacher_assignments')
            ->where('teacher_id', $teacherId)
            ->get();

        if ($assignments->isEmpty()) {
            return response()->json(['error' => 'No assigned classes found for this teacher', 'teacher_id' => $teacherId], 404);
        }

        // Fetch assigned classes with subjects
        $assignedClasses = DB::table('teacher_assignments')
            ->join('classes', 'teacher_assignments.class_id', '=', 'classes.id')
            ->join('subjects', 'teacher_assignments.subject_id', '=', 'subjects.id')
            ->where('teacher_assignments.teacher_id', $teacherId)
            ->select('classes.id as class_id', 'classes.class as class', 'subjects.subject as subject')
            ->get();

        // Debugging: Check if the query is fetching data
        if ($assignedClasses->isEmpty()) {
            return response()->json(['error' => 'Classes exist, but query is not fetching them', 'assignments' => $assignments], 404);
        }

        return response()->json($assignedClasses);
    }

// -------------------------------------------------------------------------------
// public function getLessonplans(Request $request)
// {
//     \Log::info('Filtering Subject ID:', ['subject_id' => $request->subject_id]); // Debugging log

//     $draw = $request->get('draw');
//     $start = $request->get("start");
//     $rowPerPage = $request->get("length"); // Number of rows per page
//     $columnIndex_arr = $request->get('order');
//     $columnName_arr = $request->get('columns');
//     $order_arr = $request->get('order');
//     $search_arr = $request->get('search');

//     $columnIndex = $columnIndex_arr[0]['column'] ?? 0;
//     $columnName = $columnName_arr[$columnIndex]['data'] ?? 'id';
//     $columnSortOrder = $order_arr[0]['dir'] ?? 'asc';
//     $searchValue = $search_arr['value'] ?? '';

//     $teacherId = auth()->user()->id;

//     // Start Query with Joins
//     $lessonplansQuery = DB::table('lessonplans')
//         ->join('classes', 'lessonplans.class_id', '=', 'classes.id')
//         ->join('subjects', 'lessonplans.subject_id', '=', 'subjects.id')
//         ->join('users', 'lessonplans.teacher_id', '=', 'users.id')
//         ->where('lessonplans.teacher_id', $teacherId) // Filter by logged-in teacher
//         ->select(
//             'lessonplans.id',
//             'classes.class as class',
//             'classes.section as section',
//             'subjects.id as subject_id', //  Include subject_id for filtering
//             'subjects.subject as subject',
//             'users.username as teacher',
//             'lessonplans.status as status'
//         );

//     //  Apply Subject Filter
//     if ($request->filled('subject_id')) {
//         \Log::info('Applying filter for Subject ID:', ['subject_id' => $request->subject_id]);
//         $lessonplansQuery->where('subjects.id', $request->subject_id);
//     }

//     //  Apply Search Filter
//     if (!empty($searchValue)) {
//         $lessonplansQuery->where(function ($query) use ($searchValue) {
//             $query->where('subjects.subject', 'like', "%$searchValue%")
//                   ->orWhere('classes.class', 'like', "%$searchValue%")
//                   ->orWhere('classes.section', 'like', "%$searchValue%")
//                   ->orWhere('users.username', 'like', "%$searchValue%");
//         });
//     }

//     //  Clone query to count filtered records
//     $totalRecordsWithFilter = (clone $lessonplansQuery)->count();

//     //  Ensure ordering column exists
//     $validColumns = ['id', 'class', 'section', 'subject', 'teacher', 'status'];
//     if (!in_array($columnName, $validColumns)) {
//         $columnName = 'id';
//     }

//     //  Apply Ordering & Pagination
//     $records = $lessonplansQuery
//         ->orderBy($columnName, $columnSortOrder)
//         ->skip($start)
//         ->take($rowPerPage)
//         ->get();

//     //  Prepare Data for DataTables
//     $data_arr = [];
//     foreach ($records as $record) {
//         $modify = '
//             <td class="text-end"> 
//                 <div class="actions">
//                     <a href="'.e(route('lessonplans.edit', $record->id)).'" class="btn btn-sm bg-danger-light">
//                         <i class="far fa-edit me-2"></i>
//                     </a>
//                     <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal" data-id="'.e($record->id).'" data-bs-target="#delete">
//                         <i class="fe fe-trash-2"></i>
//                     </a>
//                 </div>
//             </td>
//         ';

//         $data_arr[] = [
//             "id"       => $record->id,
//             "class"    => $record->class,
//             "section"  => $record->section,
//             "subject"  => $record->subject,
//             "teacher"  => $record->teacher,
//             "status"   => $record->status,
//             "modify"   => $modify,
//         ];
//     }

//     //  Return JSON Response for DataTables
//     return response()->json([
//         "draw"                 => intval($draw),
//         "iTotalRecords"        => $totalRecordsWithFilter,
//         "iTotalDisplayRecords" => $totalRecordsWithFilter,
//         "aaData"               => $data_arr
//     ]);
// }


    public function getLessonPlanDetails($id) {
        try {
            $lessonplan = DB::table('lessonplans')
                ->join('classes', 'lessonplans.class_id', '=', 'classes.id')
                ->join('subjects', 'lessonplans.subject_id', '=', 'subjects.id')
                ->join('users', 'lessonplans.teacher_id', '=', 'users.id') // Teachers are stored in 'users'
                ->select(
                    'lessonplans.id',
                    'lessonplans.title',
                    'lessonplans.tasks',
                    'classes.class as class',
                    'classes.section as section',
                    'subjects.subject as subject',
                    'users.username as teacher'
                )->where('lessonplans.id', $id)
                ->first();
        
            // Check if tasks are serialized and unserialize them
            if ($lessonplan && !empty($lessonplan->tasks)) {
                $lessonplan->tasks = unserialize($lessonplan->tasks);
            }
            return response()->json($lessonplan);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        

    }


    /**
     * Create Form
     *
     * @param AcademicYears $academicyear
     * @return void
     */
    public function create(AcademicYears $academicyear){
        return view("lessonplans.create",['academicyear'=>$academicyear]);
    }

    /**
     * Store Method
     *
     * @param LessonPlansRequest $request
     * @param AcademicYears $academicyear
     * @return void
     */
    public function store(LessonPlansRequest $request, AcademicYears $academicyear){
        // dd($request);
        try{
            /**
             * merge task list from rich text editor input field and serialize it before storing
             */
            $contentData = collect($request->all())->filter(function ($value, $key) {
                return str_starts_with($key, 'content_');
            });
            $taskContents = [];
            $countCheck = 0;
            foreach($contentData as $key => $value){
                $countCheck++;
                $c = [];
                $c[$key] = $value;
                $c["checkedAt_$countCheck"] = "";
                array_push($taskContents, $c);
            }

            $lessonplans = LessonPlan::create([
                'title'     =>  $request->title,
                'year_id'   =>  $academicyear::where("year","=",$request->year_id)->first()->id,//get current active year
                'class_id'   =>  $request->class_id,
                'subject_id'   =>  $request->subject_id,
                'teacher_id'   =>  $request->teacher_id,
                'start_date'   =>  $request->start_date,
                'end_date'   =>  $request->end_date,
                // 'start_time'   =>  $request->start_time,
                // 'end_time'   =>  $request->end_time,
                'tasks' =>  serialize($taskContents),
                'taskscount' => count($taskContents),
                // 'status' => Status::where('name', 'Pending')->first()->id ?? 'Pending',
            ]);
            if( $lessonplans ){
                return redirect()->route('lessonplans.index')->with('success',"Class added");
            }else{
                return redirect()->route('lessonplans.index')->with('failed',"Something went wrong, please try again");
            }
        }catch(\Exception $ex){
            // dd($ex);
            return redirect()->route('lessonplans.create')->with('failed', $ex->getMessage());
        }
    }

    /**
     * Edit Form
     *
     * @param LessonPlan $lessonplan
     * @param AcademicYears $academicyear
     * @return void
     */
    public function edit(LessonPlan $lessonplan, AcademicYears $academicyear){
        return view( "lessonplans.edit", [ 'lessonplan' => $lessonplan, 'academicyear' => $academicyear ] );
    }

    /**
     * Update Method
     *
     * @param LessonPlansRequest $request
     * @param LessonPlan $lessonplan
     * @param AcademicYears $academicyear
     * @return void
     */
    public function update(LessonPlansRequest $request, LessonPlan $lessonplan, AcademicYears $academicyear){
        try{
            // dd($request);
            /**
            * merge task list from rich text editor input field and serialize it before storing
            */
           $contentData = collect($request->all())->filter(function ($value, $key) {
               return str_starts_with($key, 'content_');
           });
           $taskContents = [];
           $countCheck = 0;
           foreach($contentData as $key => $value){
               $countCheck++;
               $c = [];
               $c[$key] = $value;
               $c["checkedAt_$countCheck"] = "";
               array_push($taskContents, $c);
           }
           $lessonplan->title = $request->title;
           $lessonplan->year_id = $academicyear::where("year","=",$request->year_id)->first()->id;
           $lessonplan->class_id = $request->class_id;
           $lessonplan->subject_id = $request->subject_id;
           $lessonplan->teacher_id = $request->teacher_id;
           $lessonplan->start_date = $request->start_date;
           $lessonplan->end_date = $request->end_date;
        //    $lessonplan->start_time = $request->start_time;
        //    $lessonplan->end_time = $request->end_time;
           $lessonplan->tasks = serialize($taskContents);
           $lessonplan->taskscount = count($taskContents);
           $lessonplan->status = "Pending";


           $statusUpdate = $lessonplan->save();
           if( $statusUpdate ){
               return redirect()->route('lessonplans.index')->with('success',"Lesson plans updated");
           }else{
               return redirect()->route('lessonplans.update',$lessonplan->id)->with('failed',"Something went wrong, try again");
           }
         
       }catch(\Exception $ex){
           return redirect()->route('lessonplans.update',$lessonplan->id)->with('failed', $ex->getMessage());
       }

    }

    /**
     * @todo Destroy Method
     *
     * @return void
     */

    public function destroy($id)
{
    $record = LessonPlan::find($id);
    
    if (!$record) {
        return redirect()->route('lessonplans.index')->with('error', 'Record not found.');
    }

    $record->delete();

    return redirect()->route('lessonplans.index')->with('success', 'Lesson Plan deleted successfully.');
}


    /**
     * Fetch Classes on input of Class
     *
     * @param Request $request
     * @return void
     */
    public function fetchClasses(Request $request){
        $classes = null;

        if ($request->q !== null) {
            $search = $request->q;
            $classes = Classes::select("id","class","section")
                ->where(function ($query) use ($search) {
                    $query->where("class", 'LIKE', "%$search%")
                    ->orWhere("section","LIKE","%$search%")
                    ->orWhere("id",$search); // Use = for id comparison
                })
                ->limit(10)
                ->get();
        } else {
            $classes = Classes::select("id","class","section")
                ->latest()
                ->limit(10)
                ->get();
        }
        return response()->json($classes);
    }

/**
     * Fetch Teacher on input of teachers
     *
     * @param Request $request
     * @return void
     */
    public function fetchTechers(Request $request){
        $teachers = null;

        if ($request->q !== null) {
            $search = $request->q;
            $teachers = User::select("id","username","email")
                ->where(function ($query) use ($search) {
                    $query->where("role", '=', 2)
                    ->where("email", 'LIKE', "%$search%")
                    ->orWhere("username","LIKE","%$search%")
                    ->orWhere("id",$search); // Use = for id comparison
                })
                ->limit(10)
                ->get();
        } else {
            $teachers = User::select("id","username","email")
            ->where("role","=",2)
                ->latest()
                ->limit(10)
                ->get();
        }
        return response()->json($teachers);
    }

    /**
     * Fetch subjects on input of subjects
     *
     * @param Request $request
     * @return void
     */
    public function fetchSubjects(Request $request){
        $subjects = null;

        if ($request->q !== null) {
            $search = $request->q;
            $subjects = Subject::select("id","subject")
                ->where(function ($query) use ($search) {
                    $query->where("subject", 'LIKE', "%$search%")
                    ->orWhere("id",$search);
                })
                ->limit(10)
                ->get();
        } else {
            $subjects = Subject::select("id","subject")
                ->latest()
                ->limit(10)
                ->get();
        }
        return response()->json($subjects);
    }

    // ------------------------------------status modal-----------------------------------------
    
    // public function getlessonPlan() {
    //     return DataTables::of(LessonPlan::query())->make(true);
    // }
    
    public function getStatus($id) {
        $lessonPlans = LessonPlan::where('id', $id)->get();
        return response()->json(['lessonPlans' => $lessonPlans]);
    } 
    public function updateStatus(Request $request) {
        $validated = $request->validate([
            'id' => 'required|exists:lessonplans,id',
            'status' => 'required|in:Upcoming,Pending,Ongoing,Completed'
        ]);

        $lessonPlan = LessonPlan::find($validated['id']);
        $lessonPlan->status = $validated['status'];
        $lessonPlan->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    } 
    public function showLessonProgress()
{
    $user = auth()->user();

    if ($user->role == 'admin') {
        // ✅ Fetch subjects and classes
        $subjects = DB::table('subjects')->pluck('subject', 'id');
        $classes = DB::table('classes')->pluck('class', 'id');

        // ✅ Fetch lesson progress with all status types
        $progress = DB::table('lessonplans')
    ->select(
        'class_id',
        'subject_id',
        DB::raw('COUNT(*) as total_lessons'),
        DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_lessons'),
        DB::raw('SUM(CASE WHEN status = "ongoing" THEN 1 ELSE 0 END) as ongoing_lessons'),
        DB::raw('SUM(CASE WHEN status = "upcoming" THEN 1 ELSE 0 END) as upcoming_lessons'),
        DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending_lessons')
    )
    ->when($user->role == 'teacher', function ($query) use ($user) {
        $query->where('teacher_id', $user->id);
    })
    ->groupBy('class_id', 'subject_id')
    ->get();


        // ✅ Fetch all lesson plans for admin
        $lessonPlans = DB::table('lessonplans')->get();

    } elseif ($user->role == 'teacher') {
        // ✅ Fetch subjects assigned to this teacher
        $subjects = DB::table('subjects')
            ->whereIn('id', function ($query) use ($user) {
                $query->select('subject_id')->from('lessonplans')->where('teacher_id', $user->id);
            })->pluck('subject', 'id');

        // ✅ Fetch classes assigned to this teacher
        $classes = DB::table('classes')
            ->whereIn('id', function ($query) use ($user) {
                $query->select('class_id')->from('lessonplans')->where('teacher_id', $user->id);
            })->pluck('class', 'id');

        // ✅ Fetch lesson progress for teacher
        $progress = DB::table('lessonplans')
            ->select(
                'class_id',
                'subject_id',
                'status',
                DB::raw('COUNT(*) as total_lessons'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_lessons'),
                DB::raw('SUM(CASE WHEN status = "ongoing" THEN 1 ELSE 0 END) as ongoing_lessons'),
                DB::raw('SUM(CASE WHEN status = "upcoming" THEN 1 ELSE 0 END) as upcoming_lessons'),
                DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending_lessons') // ✅ Added pending status
            )
            ->where('teacher_id', $user->id)
            ->groupBy('class_id', 'subject_id', 'status')
            ->get();

        // ✅ Fetch only this teacher's lesson plans
        $lessonPlans = DB::table('lessonplans')->where('teacher_id', $user->id)->get();

    } else {
        abort(403, 'Unauthorized access');
    }

    // ✅ Pass data to view
    return view('dashboard.home', compact('subjects', 'classes', 'progress', 'lessonPlans'));
}
    public function getLessonplans(Request $request)
{
    \Log::info('Filtering Subject ID:', ['subject_id' => $request->subject_id]); // Debugging log

    $draw = $request->get('draw');
    $start = $request->get("start");
    $rowPerPage = $request->get("length"); // Number of rows per page
    $columnIndex_arr = $request->get('order');
    $columnName_arr = $request->get('columns');
    $order_arr = $request->get('order');
    $search_arr = $request->get('search');

    $columnIndex = $columnIndex_arr[0]['column'] ?? 0;
    $columnName = $columnName_arr[$columnIndex]['data'] ?? 'id';
    $columnSortOrder = $order_arr[0]['dir'] ?? 'asc';
    $searchValue = $search_arr['value'] ?? '';

    $teacherId = auth()->user()->id;

    // Start Query with Joins
    $lessonplansQuery = DB::table('lessonplans')
        ->join('classes', 'lessonplans.class_id', '=', 'classes.id')
        ->join('subjects', 'lessonplans.subject_id', '=', 'subjects.id')
        ->join('users', 'lessonplans.teacher_id', '=', 'users.id')
        ->where('lessonplans.teacher_id', $teacherId) // Filter by logged-in teacher
        ->select(
            'lessonplans.id',
            'classes.class as class',
            'classes.section as section',
            'subjects.id as subject_id', 
            'subjects.subject as subject',
            'users.username as teacher',
            'lessonplans.status as status'
        );

    //  Apply Subject Filter
    if ($request->filled('subject_id')) {
        \Log::info('Applying filter for Subject ID:', ['subject_id' => $request->subject_id]);
        $lessonplansQuery->where('subjects.id', $request->subject_id);
    }

    //  Apply Search Filter
    if (!empty($searchValue)) {
        $lessonplansQuery->where(function ($query) use ($searchValue) {
            $query->where('subjects.subject', 'like', "%$searchValue%")
                  ->orWhere('classes.class', 'like', "%$searchValue%")
                  ->orWhere('classes.section', 'like', "%$searchValue%")
                  ->orWhere('users.username', 'like', "%$searchValue%");
        });
    }

    //  Clone query to count filtered records
    $totalRecordsWithFilter = (clone $lessonplansQuery)->count();

    //  Ensure ordering column exists
    $validColumns = ['id', 'class', 'section', 'subject', 'teacher', 'status'];
    if (!in_array($columnName, $validColumns)) {
        $columnName = 'id';
    }

    //  Apply Ordering & Pagination
    $records = $lessonplansQuery
        ->orderBy($columnName, $columnSortOrder)
        ->skip($start)
        ->take($rowPerPage)
        ->get();

    // Prepare Data for DataTables
    $data_arr = [];
    foreach ($records as $record) {
        $modify = '
            <td class="text-end"> 
                <div class="actions">
                    <a href="'.e(route('lessonplans.edit', $record->id)).'" class="btn btn-sm bg-danger-light">
                        <i class="far fa-edit me-2"></i>
                    </a>
                    <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal" data-id="'.e($record->id).'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                    </a>
                </div>
            </td>
        ';

        $data_arr[] = [
            "id"       => $record->id,
            "class"    => $record->class,
            "section"  => $record->section,
            "subject"  => $record->subject,
            "teacher"  => $record->teacher,
            "status"   => $record->status,
            "modify"   => $modify,
        ];
    }

    //Return JSON Response for DataTables
    return response()->json([
        "draw"                 => intval($draw),
        "iTotalRecords"        => $totalRecordsWithFilter,
        "iTotalDisplayRecords" => $totalRecordsWithFilter,
        "aaData"               => $data_arr
    ]);
}

}