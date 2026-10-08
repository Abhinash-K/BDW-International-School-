<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel;
use App\DataTables\SubjectsDataTable;
use App\Http\Requests\SubjectRequests;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index()
    {
        $subjects = Subject::all(); // Fetch all subjects from the database
        return view("subjects.index", compact("subjects"));
    }

    public function getSubject(Request $request){
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $subjects =  DB::table('subjects');
        $totalRecords = $subjects->count();

        $totalRecordsWithFilter = $subjects->where(function ($query) use ($searchValue) {
            $query->where('subject', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'name') {
            $columnName = 'name';
        }
        $records = $subjects->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('subject', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];
        
        foreach ($records as $key => $record) {
            $modify = '
                <td class="text-right">
                    <div class="dropdown dropdown-action">
                        <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v ellipse_color"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.route('subjects.edit', $record->id).'">
                                <i class="far fa-edit me-2"></i> Edit
                            </a>
                            <a class="dropdown-item" href="'.url('subjects/delete/'.$record->id).'">
                            <i class="fas fa-trash-alt m-r-5"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            ';

            $modify = '
                <td class="text-end"> 
                    <div class="actions">
                        <a href="'.route('subjects.edit', $record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete id" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';
           
            $data_arr [] = [
                "id"      => $record->id,
                "subject"         => $record->subject,
                "modify"       => $modify, 
            ];
        }

        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];
        return response()->json($response);

    }
   
    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        return view("subjects.create");
    }

    /**
     * Store a newly created subject in storage.
     */
    public function store(SubjectRequests $request)
    {
        try {
            Subject::create(['subject' => $request->subject]);

            return redirect()->route('subjects.index')->with('success', "Subject added successfully!");
        } catch (\Exception $ex) {
            return redirect()->route('subjects.create')->with('failed', $ex->getMessage());
        }
    }

    /**
     * Show the form for editing a subject.
     */
    public function edit(Subject $subject)
    {
        return view("subjects.edit", compact('subject'));
    }

    /**
     * Update the specified subject in storage.
     */
    public function update(SubjectRequests $request, Subject $subject)
    {
        // dd($subject->id);
        try {
            if (Subject::where('subject', $request->subject)->where('id', '!=', $subject->id)->exists()) {
                return redirect()->route("subjects.edit", $subject->id)->with("failed", "Subject already exists.");
            }

            $subject->update(['subject' => $request->subject]);

            return redirect()->route("subjects.index")->with("success", "Subject updated successfully.");
        } catch (\Exception $ex) {
            return redirect()->route("subjects.edit", $subject->id)->with("failed", $ex->getMessage());
        }
    }

    /**
     * Display the specified subject.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Remove the specified subject from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
    
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
    // public function getSubjectsByClass($class_id)
    // {
    //     $class = ClassModel::with('subjects')->findOrFail($class_id);
    //     return response()->json($class->subjects);
    // }
    public function getSubjectsByClass($class_id)
    {
        $subjects = Subject::where('class_id', $class_id)->get();

        if ($subjects->isEmpty()) {
            return response()->json(['message' => 'No subjects found for this class.'], 404);
        }

        return response()->json($subjects);
    }
    public function importSubjects(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new SubjectsImport, $request->file('file'));

            return back()->with('success', 'Subjects imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing subjects: ' . $e->getMessage());
        }
    }
    // public function importSubjects(Request $request)
    // {
    //     return response()->json(['message' => 'Import route is working!'], 200);
    // }
    


}
