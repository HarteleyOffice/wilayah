<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_province extends Controller
{
    //add new province
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $province = new Province;
        $province->name = $request->input('name');
        $userId = Auth::id();
        $province->created_by = $userId;
        $province->save();
        return 'Saved';
        }
    }

    //update province's name
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:provinces,id',
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $province = Province::find($id);
        $province->name = $request->input('name');
        $userId = Auth::id();
        $province->updated_by = $userId;
        $province->save();
        return 'Saved';
        }
    }

    //delete province
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:provinces,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request('id');
        $province_id = Province::find($id)->delete();
        return $province_id;
        }
    }

    //get province from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:provinces,id',
            'name' => 'max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = Province::query();

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
        $villages = $query->get();
        return $villages;
        }
    }
}
