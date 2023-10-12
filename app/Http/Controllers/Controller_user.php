<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_user extends Controller
{
    //add new user
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:100',
            'username' => 'required|max:60',
            'password' => 'required|max:255',
            'email' => 'max:100|nullable',
            'phone' => 'numeric|min:0|max:1000000000000000|nullable',
            'should_change_password' => 'required|boolean',
            'hris_role_id' => 'exists:hris_roles,id|nullable',
            'pugindo_role_id' => 'exists:pugindo_roles,id|nullable',
            'portal_role_id' => 'exists:portal_roles,id|nullable',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $user = new User;
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $password = $request->input('password');
        $hashedpassword = bcrypt($password);
        $user->password = $hashedpassword;
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->should_change_password = $request->input('should_change_password');
        $user->hris_role_id = $request->input('hris_role_id');
        $user->pugindo_role_id = $request->input('pugindo_role_id');
        $user->portal_role_id = $request->input('portal_role_id');
        $userId = Auth::id();
        $user->created_by = $userId;
        $user->save();
        return 'Saved';
        }
    }

    //update user
    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'fullname' => 'required|max:100',
            'username' => 'required|max:60',
            'password' => 'required|max:255',
            'email' => 'max:100|nullable',
            'phone' => 'numeric|min:0|max:1000000000000000|nullable',
            'should_change_password' => 'required|boolean',
            'hris_role_id' => 'exists:hris_roles,id|nullable',
            'pugindo_role_id' => 'exists:pugindo_roles,id|nullable',
            'portal_role_id' => 'exists:portal_roles,id|nullable',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $user = User::find($id);
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $password = $request->input('password');
        $hashedpassword = bcrypt($password);
        $user->password = $hashedpassword;
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->should_change_password = $request->input('should_change_password');
        $user->hris_role_id = $request->input('hris_role_id');
        $user->pugindo_role_id = $request->input('pugindo_role_id');
        $user->portal_role_id = $request->input('portal_role_id');
        $userId = Auth::id();
        $user->updated_by = $userId;
        $user->save();
        return 'Saved';
        }
    }

    //delete user
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $user_id = User::find($id)->delete();
        return $user_id;
        }
    }

    //get user from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:users,id',
            'fullname' => 'max:100',
            'username' => 'max:60',
            'password' => 'max:255',
            'email' => 'max:100',
            'phone' => 'numeric|min:0|max:1000000000000000',
            'should_change_password' => 'boolean',
            'hris_role_id' => 'exists:hris_roles,id',
            'pugindo_role_id' => 'exists:pugindo_roles,id',
            'portal_role_id' => 'exists:portal_roles,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = User::query();

        // Query by id
        if($request->has('id')) {
            $id = $request->input('id');
            $query->where('id', $id);
        }

        // Query by fullname
        if($request->has('fullname')) {
            $fullname = $request->input('fullname');
            $query->where('fullname', 'LIKE', '%'.$fullname.'%');
        }

        // Query by username
        if($request->has('username')) {
            $username = $request->input('username');
            $query->where('username', 'LIKE', '%'.$username.'%');
        }

        // Query by email
        if($request->has('email')) {
            $email = $request->input('email');
            $query->where('email', 'LIKE', '%'.$email.'%');
        }

        // Query by phone
        if($request->has('phone')) {
            $phone = $request->input('phone');
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }

        // Query by should_change_password
        if($request->has('should_change_password')) {
            $should_change_password = $request->input('should_change_password');
            $query->where('should_change_password', $should_change_password);
        }

        // Query by hris_role_id
        if($request->has('hris_role_id')) {
            $hris_role_id = $request->input('hris_role_id');
            $query->where('hris_role_id', $hris_role_id);
        }

        // Query by pugindo_role_id
        if($request->has('pugindo_role_id')) {
            $pugindo_role_id = $request->input('pugindo_role_id');
            $query->where('pugindo_role_id', $pugindo_role_id);
        }

        // Query by portal_role_id
        if($request->has('portal_role_id')) {
            $portal_role_id = $request->input('portal_role_id');
            $query->where('portal_role_id', $portal_role_id);
        }

        // Get All the results
        $branches = $query->get();
        return $branches;
        }
    }

}

