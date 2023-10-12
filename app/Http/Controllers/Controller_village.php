<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_village extends Controller
{
    //add new village
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'district_id' => 'required|exists:districts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $village = new Village;
        $village->name = $request->input('name');
        $village->district_id = $request->input('district_id');
        $userId = Auth::id();
        $village->created_by = $userId;
        $village->save();
        return 'Saved';
        }
    }

    //update village's name
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:villages,id',
            'name' => 'required|max:100',
            'district_id' => 'required|exists:districts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $village = Village::find($id);
        $village->name = $request->input('name');
        $village->district_id = $request->input('district_id');
        $userId = Auth::id();
        $village->updated_by = $userId;
        $village->save();
        }
    }

    //delete village
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:villages,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $village_id = Village::find($id)->delete();
        return $village_id;
        }
    }

    //get village from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:villages,id',
            'name' => 'max:100',
            'district_id' => 'exists:districts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = Village::query();

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

        // Query by district_id
        if($request->has('district_id')) {
            $district_id = $request->input('district_id');
            $query->where('district_id', $district_id);
        }

        // Get All the results
        $villages = $query->get();
        return $villages;
        }
    }
}
