<?php

namespace App\Http\Controllers;

use App\Models\Pugindo_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_pugindo_role extends Controller
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

        $pugindo_role = new Pugindo_role;
        $pugindo_role->name = $request->input('name');
        $userId = Auth::id();
        $pugindo_role->created_by = $userId;
        $pugindo_role->save();
        return 'Saved';
        }
    }

    //update role
    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:pugindo_roles,id',
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $pugindo_role = Pugindo_role::find($id);
        $pugindo_role->name = $request->input('name');
        $userId = Auth::id();
        $pugindo_role->updated_by = $userId;
        $pugindo_role->save();
        return 'Saved';
        }
    }

    //delete role
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:pugindo_roles,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $role_id = Pugindo_role::find($id)->delete();
        return $role_id;
        }
    }

    //get pugindo_roles from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:pugindo_roles,id',
            'name' => 'max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = Pugindo_role::query();

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
        $pugindo_roles = $query->get();
        return $pugindo_roles;
        }
    }

}
