<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LessonPlansRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && ($user->isAdmin() || $user->isCoordinator() || $user->isTeacher());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
        $rules = [
            'title'=>'nullable',
            'year_id'=>'nullable',
            'class_id'=>'nullable',
            'subject_id'=>'nullable',
            'teacher_id'=>'nullable',
            'start_date'=>'nullable',
            'end_date'=>'nullable'
            // 'end_time'=>'nullable'
        ];
        if ($user->isTeacher()) {
            $rules = [
                'tasks' => 'nullable',
            ];
        }
        return $rules;
    }
}
