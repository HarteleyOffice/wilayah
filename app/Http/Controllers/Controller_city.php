<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_city extends Controller
{
    //add new city
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'code' => 'required',
            'province_id' => 'required|exists:provinces,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {
        
        $city = new City;
        $city->name = $request->input('name');
        $city->code = $request->input('code');
        $city->province_id = $request->input('province_id');
        $userId = Auth::id();
        $city->created_by = $userId;
        $city->save();
        return 'Saved';
        }
    }

    //update city's name
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:cities,id',
            'name' => 'required|max:100',
            'code' => 'required',
            'province_id' => 'required|exists:provinces,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $city = City::find($id);
        $city->name = $request->input('name');
        $city->code = $request->input('code');
        $city->province_id = $request->input('province_id');
        $userId = Auth::id();
        $city->updated_by = $userId;
        $city->save();
        return 'Saved';
        }
    }

    //delete city
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:cities,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $city_id = City::find($id)->delete();
        return $city_id."deleted";
        }
    }

    //get city from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:cities,id',
            'name' => 'max:100',
            'province_id' => 'exists:provinces,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = City::query();

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

        // Query by code
        if($request->has('code')) {
            $code = $request->input('code');
            $query->where('code', 'LIKE', '%'.$code.'%');

        }

        // Query by province_id
        if($request->has('province_id')) {
            $province_id = $request->input('province_id');
            $query->where('province_id', $province_id);
        }

        // Get All the results
        $cities = $query->get();
        return $cities;
        }
    }
}
