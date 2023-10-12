<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller_branch extends Controller
{
        //add new branch
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'city_id' => 'required|exists:cities,id',
                'type' => 'required|in:HO,CA,CT',
                'class' => 'required|in:1,2,3',
                'address' => 'required|max:255',
                'phone' => 'required|numeric|min:2|max:100000000000000000000',
                'is_active' => 'required|boolean',
                'ip_address' => 'max:100|nullable',
                'lat' => 'between:0,180.999999|nullable',
                'lng' => 'between:-180.999999,180.999999|nullable',
                'kepala_unit_id' => 'exists:users,id|nullable',
                'kepala_cabang_id' => 'exists:users,id|nullable',
                'wakil_area_manager_id' => 'exists:users,id|nullable',
                'area_manager_id' => 'exists:users,id|nullable',
                'company_id' => 'exists:companies,id|nullable',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 400);
            } else {

            $branch = new Branch;

            //name autofill
            $city_id = $request->input('city_id');
            $count = Branch::where('city_id',$city_id)->count();
            $count = $count + 1;
            $counted = str_pad($count, 3, '0', STR_PAD_LEFT);
            $find = City::find($city_id)->code;
            $name = $find.$counted;
            $branch->name = $name;

            //code autofill
            $get_all = DB::table('branches')->count();
            $code = $get_all + 1;
            $coded = str_pad($code, 3, '0', STR_PAD_LEFT);
            $branch->code = $coded;

            $branch->type = $request->input('type');
            $branch->class = $request->input('class');
            $branch->address = $request->input('address');
            $branch->phone = $request->input('phone');
            $branch->is_active = $request->input('is_active');
            $branch->city_id = $city_id;
            $branch->ip_address = $request->input('ip_address');
            $branch->lat = $request->input('lat');
            $branch->lng = $request->input('lng');
            $branch->kepala_unit_id = $request->input('kepala_unit_id');
            $branch->kepala_cabang_id = $request->input('kepala_cabang_id');
            $branch->wakil_area_manager_id = $request->input('wakil_area_manager_id');
            $branch->area_manager_id = $request->input('area_manager_id');
            $branch->company_id = $request->input('company_id');
            $userId = Auth::id();
            $branch->created_by = $userId;
            $branch->save();
            return 'Saved';
            }
        }
    
        //update branch's name
        public function update(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:branches,id',
                'type' => 'required|in:HO,CA,CT',
                'class' => 'required|in:1,2,3',
                'address' => 'required|max:255',
                'phone' => 'required|numeric|min:2|max:100000000000000000000',
                'is_active' => 'required|boolean',
                'ip_address' => 'max:100|nullable',
                'lat' => 'between:0,180.999999|nullable',
                'lng' => 'between:-180.999999,180.999999|nullable',
                'kepala_unit_id' => 'exists:users,id|nullable',
                'kepala_cabang_id' => 'exists:users,id|nullable',
                'wakil_area_manager_id' => 'exists:users,id|nullable',
                'area_manager_id' => 'exists:users,id|nullable',
                'company_id' => 'exists:companies,id|nullable',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 400);
            } else {

            $id = $request->input('id');
            $branch = Branch::find($id);
            $branch->type = $request->input('type');
            $branch->class = $request->input('class');
            $branch->address = $request->input('address');
            $branch->phone = $request->input('phone');
            $branch->is_active = $request->input('is_active');
            $branch->ip_address = $request->input('ip_address');
            $branch->lat = $request->input('lat');
            $branch->lng = $request->input('lng');
            $branch->kepala_unit_id = $request->input('kepala_unit_id');
            $branch->kepala_cabang_id = $request->input('kepala_cabang_id');
            $branch->wakil_area_manager_id = $request->input('wakil_area_manager_id');
            $branch->area_manager_id = $request->input('area_manager_id');
            $branch->company_id = $request->input('company_id');
            $userId = Auth::id();
            $branch->updated_by = $userId;
            $branch->save();
            return 'Saved';
            }
        }
    
        //delete branch
        public function delete(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:branches,id',
            ]);
        
            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 400);
            } else {

            $id = $request->input('id');
            $branch_id = Branch::find($id)->delete();
            return $branch_id;
            }
        }

        //get branch from filters
        public function filters(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id' => 'exists:branches,id',
                'name' => 'max:100',
                'code' => 'max:5',
                'type' => 'in:HO,CA,CT',
                'class' => 'in:1,2,3',
                'address' => 'max:255',
                'phone' => 'numeric|min:2|max:100000000000000000000',
                'is_active' => 'boolean',
                'city_id' => 'exists:cities,id',
                'ip_address' => 'max:100',
                'lat' => 'between:0,180.999999',
                'lng' => 'between:-180.999999,180.999999',
                'kepala_unit_id' => 'exists:users,id',
                'kepala_cabang_id' => 'exists:users,id',
                'wakil_area_manager_id' => 'exists:users,id',
                'area_manager_id' => 'exists:users,id',
                'company_id' => 'exists:companies,id',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 400);
            } else {

            // Start the query
            $query = Branch::query();

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
                $query->where('code', $code);
            }

            // Query by type
            if($request->has('type')) {
                $type = $request->input('type');
                $query->where('type', $type);
            }

            // Query by class
            if($request->has('class')) {
                $class = $request->input('class');
                $query->where('class', $class);
            }

            // Query by address
            if($request->has('address')) {
                $address = $request->input('address');
                $query->where('address', 'LIKE', '%'.$address.'%');
            }

            // Query by phone
            if($request->has('phone')) {
                $phone = $request->input('phone');
                $query->where('phone', 'LIKE', '%'.$phone.'%');
            }

            // Query by is_active
            if($request->has('is_active')) {
                $is_active = $request->input('is_active');
                $query->where('is_active', $is_active);
            }

            // Query by city_id
            if($request->has('city_id')) {
                $city_id = $request->input('city_id');
                $query->where('city_id', $city_id);
            }

            // Query by ip_address
            if($request->has('ip_address')) {
                $ip_address = $request->input('ip_address');
                $query->where('ip_address', 'LIKE', '%'.$ip_address.'%');
            }

            // Query by lat
            if($request->has('lat')) {
                $lat = $request->input('lat');
                $query->where('lat', 'LIKE', '%'.$lat.'%');
            }

            // Query by lng
            if($request->has('lng')) {
                $lng = $request->input('lng');
                $query->where('lng', 'LIKE', '%'.$lng.'%');
            }

            // Query by kepala_unit_id
            if($request->has('kepala_unit_id')) {
                $kepala_unit_id = $request->input('kepala_unit_id');
                $query->where('kepala_unit_id', $kepala_unit_id);
            }

            // Query by kepala_cabang_id
            if($request->has('kepala_cabang_id')) {
                $kepala_cabang_id = $request->input('kepala_cabang_id');
                $query->where('kepala_cabang_id', $kepala_cabang_id);
            }

            // Query by wakil_area_manager_id
            if($request->has('wakil_area_manager_id')) {
                $wakil_area_manager_id = $request->input('wakil_area_manager_id');
                $query->where('wakil_area_manager_id', $wakil_area_manager_id);
            }

            // Query by area_manager_id
            if($request->has('area_manager_id')) {
                $area_manager_id = $request->input('area_manager_id');
                $query->where('area_manager_id', $area_manager_id);
            }

            // Query by company_id
            if($request->has('company_id')) {
                $company_id = $request->input('company_id');
                $query->where('company_id', $company_id);
            }

            // Get All the results
            $branches = $query->get();
            return $branches;
            }
        }
}
