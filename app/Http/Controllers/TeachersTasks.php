<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\TeachersTasksDataTable;
use App\Models\LessonPlan;
use App\Http\Requests\LessonPlansRequest;

class TeachersTasks extends Controller
{
    /**
     * Render Lesson Plans List
     *
     * @param LessonPlansDataTable $datatable
     * @return void
     */
    public function index(TeachersTasksDataTable $datatable){
        return $datatable->render("classes.index");
    }


    public function show(LessonPlan $teacherstask){
        
    }

    /**
     * Edit Form
     *
     * @param LessonPlan $lessonplan
     * @param AcademicYears $academicyear
     * @return void
     */
    public function edit(LessonPlan $teacherstask){
        return view( "teacherstasks.edit", [ 'teacherstask' => $teacherstask ] );
    }

    /**
     * Update Method
     *
     * @param LessonPlansRequest $request
     * @param LessonPlan $lessonplan
     * @param AcademicYears $academicyear
     * @return void
     */
    public function update(LessonPlansRequest $request, LessonPlan $teacherstask){
        
        try{

            $contentData = [];
            $requestData = $request->all(); // Get all the request data
            
            foreach ($requestData as $key => $value) {
                // Match keys like 'content_1', 'checked_1', etc.
                if (preg_match('/^(content|checkedAt)_(\d+)$/', $key, $matches)) {
                    $groupIndex = $matches[2]; // Extract the numeric suffix (e.g., '1' from 'content_1')
                    $contentData[$groupIndex][$key] = $value; // Group by index and preserve key-value pairs
                }
            }
            
            // Reformat to ensure sequential numeric keys (optional)
            $contentData = array_values($contentData);

            $isComplete = collect($request->all())->filter(function ($value, $key) {
                return str_starts_with($key, 'checkedAt_') && $value == "";
            });
            
            $teacherstask->title = $teacherstask->title;
            $teacherstask->tasks = serialize($contentData);
            $teacherstask->taskscount = count($contentData);
            $teacherstask->status = count($isComplete) > 0 ? "Pending" : "Completed";

            $statusUpdate = $teacherstask->save();
            // dd($statusUpdate);
            if( $statusUpdate ){
                return redirect()->route('teacherstasks.index')->with('success',"Lesson plans updated");
            }else{
                return redirect()->route('teacherstasks.update',$teacherstask->id)->with('failed',"Something went wrong, try again");
            }
          
        }catch(\Exception $ex){
            return redirect()->route('teacherstasks.update',$teacherstask->id)->with('failed', $ex->getMessage());
        }

    }
}
