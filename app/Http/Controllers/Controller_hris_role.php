<?php

namespace App\Http\Controllers;

use App\Models\Hris_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_hris_role extends Controller
{
    //add new role
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $hris_role = new Hris_role;
        $hris_role->name = $request->input('name');
        $userId = Auth::id();
        $hris_role->created_by = $userId;
        $hris_role->save();
        return 'Saved';
        }
    }

    //update role
    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:hris_roles,id',
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $hris_role = Hris_role::find($id);
        $hris_role->name = $request->input('name');
        $userId = Auth::id();
        $hris_role->updated_by = $userId;
        $hris_role->save();
        return 'Saved';
        }
    }

    //delete role
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:hris_roles,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $role_id = Hris_role::find($id)->delete();
        return $role_id;
        }
    }

    //get hris_roles from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:hris_roles,id',
            'name' => 'max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = Hris_role::query();

        // Query by id
        if($request->has('id')) {
            $id = $request->input('id');
            $query->where('id', $id);
        }

        // Query by name
        if($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', 'LIKE', '%'.$name.'%');

        }

        // Get All the results
        $hris_roles = $query->get();
        return $hris_roles;
        }
    }

}
