<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_district extends Controller
{
    //add new district
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'city_id' => 'required|exists:cities,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $district = new District;
        $district->name = $request->input('name');
        $district->city_id = $request->input('city_id');
        $userId = Auth::id();
        $district->created_by = $userId;
        $district->save();
        return 'Saved';
        }
    }

    //update district's name
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:districts,id',
            'name' => 'required|max:100',
            'city_id' => 'required|exists:cities,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $district = District::find($id);
        $district->name = $request->input('name');
        $district->city_id = $request->input('city_id');
        $userId = Auth::id();
        $district->updated_by = $userId;
        $district->save();
        return 'Saved';
        }
    }

    //delete district
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:districts,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $district_id = District::find($id)->delete();
        return $district_id;
        }
    }

    //get district from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:districts,id',
            'name' => 'max:100',
            'city_id' => 'exists:cities,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = District::query();

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

        // Query by city_id
        if($request->has('city_id')) {
            $city_id = $request->input('city_id');
            $query->where('city_id', $city_id);
        }

        // Get All the results
        $districts = $query->get();
        return $districts;
        }
    }
}
