<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Users Class
 */
class Users extends Controller
{
    /**
     * Render Users List
     *
     * @param UsersDataTable $dataTable
     * @return void
     */
    public function index()
    {
        $users = User::get();
        return view("users.index",['users'=>$users]);
    }

    public function getUsers(Request $request){
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
    
        // Fetch users
        $users = DB::table('users');
    
        // Apply Search Filter
        if (!empty($searchValue)) {
            $users->where(function ($query) use ($searchValue) {
                $query->where('username', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
                    // ->join('role', 'like', '%' . $searchValue . '%');
            });
        }
    
        $totalRecords = $users->count();
        $totalRecordsWithFilter = $users->count();
    
        // Apply sorting, pagination, and execute the query
        $records = $users
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
    
        // Format data for DataTables
        $data_arr = [];
        foreach ($records as $record) {
            
            $modify = '
                <td class="text-end"> 
                    <div class="actions">
                        <a href="'.route('users.edit', $record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                            <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';
    
            $data_arr[] = [
                "id"        => $record->id,
                "username"  => $record->username,
                "email"     => $record->email,
                // "role"      => $record->role,
                "modify"    => $modify,
            ];
        }
    
        // Prepare response for DataTables
        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];
    
        return response()->json($response);
    }
    

    /**
     * Create Form
     *
     * @return void
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store Method
     *
     * @param UserRequest $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        //validate if not existing user
        $existingUser = User::where('username', $request->username)
            ->orWhere('email', $request->email)
            ->first();

        if ($existingUser) {
            return redirect()->route('users.create')->with('failed', 'User already registered');
        }
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make(123456),
                'role' => $request->role,
            ]);
            return redirect()->route('users.index');
        } catch (\Exception $ex) {
            return redirect()->route('users.create')->with('failed', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Users::destroy($user);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view("users.edit", ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        try {
            $fields = $request->validate([
                'username' => 'required|max:255|unique:users,username,' . $user->id,
                'email' => 'required|max:100|email|unique:users,email,' . $user->id,
                'role' => 'required|integer|between:0,2',
                'password' => 'nullable|min:6|max:16'
            ]);

            // Update user data
            $user->username = $fields['username'];
            $user->email = $fields['email'];
            $user->role = $fields['role'];

            // Only update the password if it’s provided
            if (!empty($fields['password'])) {
                $user->password = bcrypt($fields['password']);
            }

            $statusUpdate = $user->save();
            if (true === $statusUpdate) {
                return redirect()->route('users.index')->with('success', 'User updated successfully.');
            } else {
                return redirect()->route('users.edit')->with('failed', 'Something went wrong, try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('users.edit')->with('failed', 'Something went wrong, try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {  
        try {
            $statusDelete = User::where('id', $id)->forceDelete();
            if( $statusDelete ){
                return redirect()->route('users.index')->with('success', 'User deleted successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('failed', 'Something went wrong, try again.'.$e->getMessage());
        }
    }
}
