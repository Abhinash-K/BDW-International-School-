<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AcademicYearsRequests;
use App\Models\AcademicYears;
use App\DataTables\AcademicYearsDataTable;
use Illuminate\Support\Facades\DB;

/**
 * Academic Year Class
 */
class AcademicYearsController extends Controller
{

    /**
     * Academic Years List
     *
     * @param AcademicYearsDataTable $datatable
     * @return void
     */
    public function index(){
        return view("academicyears.index");
    }

    public function getAcademicyear(Request $request){
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

        $subjects =  DB::table('academic_years');
        $totalRecords = $subjects->count();

        $totalRecordsWithFilter = $subjects->where(function ($query) use ($searchValue) {
            $query->where('year', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'name') {
            $columnName = 'name';
        }
        $records = $subjects->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('year', 'like', '%' . $searchValue . '%');
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
                            <a class="dropdown-item" href="'.route('academicyears.edit', $record->id).'">
                                <i class="far fa-edit me-2"></i> Edit
                            </a>
                            <a class="dropdown-item" href="'.url('academicyears/delete/'.$record->id).'">
                            <i class="fas fa-trash-alt m-r-5"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            ';

            $modify = '
                <td class="text-end"> 
                    <div class="actions">
                        <a href="'.route('academicyears.edit', $record->id).'" class="btn btn-sm bg-danger-light">
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
                "year"         => $record->year,
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
     * Insert Form
     *
     * @return void
     */
    public function create(){
        return view("academicyears.create");
    }

    /**
     * Store method
     *
     * @param AcademicYearsRequests $request
     * @return void
     */
    public function store(AcademicYearsRequests $request){
        try{
            $years = AcademicYears::create([
                'year'      =>  $request->year,
                'current'   =>  $request->has('current') ? 1 : 0
            ]);
            if( $years ){
                return redirect()->route("academicyears.index")->with("success","Academic year added");
            }else{
                return redirect()->route("academicyears.create")->with("failed","Something went wrong, try again");
            }

        }catch(\Exception $ex){
            return redirect()->route('academicyears.create')->with('failed', $ex->getMessage());
        }
    }

    /**
     * Edit Form
     *
     * @param AcademicYears $academicyear
     * @return void
     */
    public function edit(AcademicYears $academicyear){
        return view('academicyears.edit',['academicyear'=>$academicyear]);
    }

    /**
     * Update Method
     *
     * @param AcademicYearsRequests $request
     * @param AcademicYears $academicyear
     * @return void
     */
    public function update(AcademicYearsRequests $request, AcademicYears $academicyear){
        try{
            $fields = $request->validate([
                'year' => 'required|numeric|digits:4|between:2000,2100',
            ]);
            $academicyear->year = $fields['year'];
            $academicyear->current = $request->has('current') ? 1 : 0; 
            $statusUpdate = $academicyear->save();
            if( true === $statusUpdate ){
                return redirect()->route("academicyears.index")->with("success","Year updated");
            }else{
                return redirect()->route("academicyears.edit",$academicyear->id)->with("failed","Somehting went wrong, try again");
            }
            
        }catch(\Exception $ex){
            return redirect()->route("academicyears.edit",$academicyear->id)->with("failed",$ex->getMessage());
        }
    }
    public function show($id)
    {
        // Retrieve the class by ID
        $academic = AcademicYears::findOrFail($id);

        // Return a view or response
        return view('academicyears.show', compact('academic'));
    }
    public function destroy($id)
    {
        $academic = AcademicYears::findOrFail($id);
        $academic->delete();
    
        return redirect()->route('academicyears.index')->with('success', 'Academic Years deleted successfully!');
    }

}
