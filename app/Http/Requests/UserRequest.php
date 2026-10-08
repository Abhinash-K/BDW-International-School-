<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();

        // Check if the user is authenticated and either an admin or a coordinator
        if ($user && ($user->isAdmin() || $user->isCoordinator())) {
            return true; // Authorized
        }

        // return false; // Unauthorized if user is neither admin nor coordinator
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
        $user = Auth::user();
        return [
            'role' => 'required|string|in:1,2,users', // Example roles
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ];
    }

    /**
     * Customize the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'role.in' => 'The selected role is invalid.',
        ];
    }
}