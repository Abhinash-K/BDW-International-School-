<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BulkDataImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Handle the import of teachers.
     *
     * @param array $row
     * @return User
     */
    public function model(array $row)
    {
        // Ensure the data contains the necessary fields
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        
        // Hash the password before storing
        $hashedPassword = Hash::make($password);

        // Check if the user already exists by email or username
        $user = User::firstOrNew(['email' => $email]);
        
        // If the user doesn't exist by email, set the username
        if (!$user->exists) {
            $user->username = $username;
        }

        // Update or insert the teacher with role 2
        $user->password = $hashedPassword;
        $user->role = 2; // Teacher role
        $user->save();

        return $user;
    }

    /**
     * Validation rules for the import.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }
}
