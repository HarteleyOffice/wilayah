<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_company extends Controller
{
    //add new company
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $company = new Company;
        $company->name = $request->input('name');
        $userId = Auth::id();
        $company->created_by = $userId;
        $company->save();
        return 'Saved';
        }
    }

    //update company
    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:companies,id',
            'name' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $company = Company::find($id);
        $company->name = $request->input('name');
        $userId = Auth::id();
        $company->updated_by = $userId;
        $company->save();
        return 'Saved';
        }
    }

    //delete company
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:companies,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        $id = $request->input('id');
        $role_id = Company::find($id)->delete();
        return $role_id;
        }
    }

    //get company from filters
    public function filters(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'exists:companies,id',
            'name' => 'max:100',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        } else {

        // Start the query
        $query = Company::query();

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
        $companies = $query->get();
        return $companies;
        }
    }

}
