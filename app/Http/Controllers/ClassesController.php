<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Http\Requests\ClassesRequests;
use App\DataTables\ClassesDataTable;
use Illuminate\Support\Facades\DB;

/**
 * Classes Class
 */ 
class ClassesController extends Controller
{
    /**
     * Render Class List
     *
     * @param ClassesDataTable $datatable
     * @return void
     */
    public function index(){
        return view("classes.index");
    }

    public function getClasses(Request $request){
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

        $classes =  DB::table('classes');
        $totalRecords = $classes->count();

        $totalRecordsWithFilter = $classes->where(function ($query) use ($searchValue) {
            $query->where('class', 'like', '%' . $searchValue . '%');
            $query->orWhere('section', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'name') {
            $columnName = 'name';
        }
        $records = $classes->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('class', 'like', '%' . $searchValue . '%');
                $query->orWhere('section', 'like', '%' . $searchValue . '%');
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
                            <a class="dropdown-item" href="'.route('classes.edit', $record->id).'">
                                <i class="far fa-edit me-2"></i> Edit
                            </a>
                            <a class="dropdown-item" href="'.url('classes/delete/'.$record->id).'">
                            <i class="fas fa-trash-alt m-r-5"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            ';

            $modify = '
                <td class="text-end"> 
                    <div class="actions">
                        <a href="'.route('classes.edit', $record->id).'" class="btn btn-sm bg-danger-light">
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
                "class"         => $record->class,
                "section"         => $record->section,
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
     * Render Create form
     *
     * @return void
     */ 
    public function create(){
        return view("classes.create");
    }

    /**
     * Store method
     *
     * @param ClassesRequests $request
     * @return void
     */
    public function store(ClassesRequests $request){
        $existingClass = Classes::where('class', $request->class)
            ->where('section', $request->section)
            ->first();

        if ($existingClass) {
            return redirect()->route('classes.create')->with('failed', 'Class already registered');
        }
        $classValidation = $request->validate([
            'class' => [
                'required',
                'regex:/^(I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII)$/',
            ],
            'section' => [
                'required',
                'regex:/^[ABC]$/',
                'max:1',
            ],
        ]);
        

        try{
            $classes = Classes::create([
                'class'     =>  $classValidation['class'],
                'section'   =>  $classValidation['section']
            ]);
            if( true === $classes ){
                return redirect()->route('classes.index')->with('success',"Class added");
            }else{
                return redirect()->route('classes.index')->with('failed',"Something went wrong, please try again");
            }
        }catch(\Exception $ex){
            return redirect()->route('classes.create')->with('failed', $ex->getMessage());
        }
    }

    /**
     * Edit Form
     *
     * @param Classes $classes
     * @return void
     */ 
    public function edit(Classes $class){
        return view( 'classes.edit', ['class'=>$class] );
    }

    /**
     * Update Method
     *
     * @param ClassesRequests $request
     * @param Classes $classes
     * @return void
     */
    public function update(ClassesRequests $request, Classes $class){
        try {
            // Check if the combination of class and section already exists
            $existingClass = Classes::where('class', $request->class)
                ->where('section', $request->section)
                ->where('id', '!=', $class->id) // Ensure it's not the same record being updated
                ->first();
    
            if ($existingClass) {
                return redirect()->route('classes.edit', $class->id)
                    ->with('failed', 'Class with this section already exists.');
            }
    
            // Validate input
            $fields = $request->validate([
                'class' => [
                    'required',
                    'regex:/^(I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII)$/',
                ],
                'section' => [
                    'required',
                    'regex:/^[ABC]$/',
                    'max:1',
                ],
            ]);
    
            $class->class = $fields['class'];
            $class->section = $fields['section'];
    
            $statusUpdate = $class->save();
    
            if ($statusUpdate) {
                return redirect()->route("classes.index")->with("success", "Class updated successfully");
            } else {
                return redirect()->route("classes.edit", $class->id)->with("failed", "Class update failed");
            }
        } catch (\Exception $ex) {
            return redirect()->route("classes.edit", $class->id)->with("failed", $ex->getMessage());
        }
    }
    public function show($id)
    {
        // Retrieve the class by ID
        $class = Classes::findOrFail($id);

        // Return a view or response
        return view('classes.show', compact('class'));
    }


    /**
     * @todo Destory Method
     *
     * @return void
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();
    
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
        

}
