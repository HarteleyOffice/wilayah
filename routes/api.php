<?php

use App\Http\Controllers\Controller_branch;
use App\Http\Controllers\Controller_province;
use App\Http\Controllers\Controller_city;
use App\Http\Controllers\Controller_district;
use App\Http\Controllers\Controller_hris_role;
use App\Http\Controllers\Controller_village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Controller_province route
Route::controller(Controller_province::class)->group(function () {
    //insert new province
    Route::post('/province/add', 'App\Http\Controllers\Controller_province@store');
    //update province
    Route::post('/province/update', 'App\Http\Controllers\Controller_province@update');
    //delete province
    Route::post('/province/delete', 'App\Http\Controllers\Controller_province@delete');
    //get filtered province
    Route::get('/provinces', 'App\Http\Controllers\Controller_province@filters');
});

//Controller_city route
Route::controller(Controller_city::class)->group(function () {
    //insert new city
    Route::post('/city/add', 'App\Http\Controllers\Controller_city@store');
    //update city
    Route::post('/city/update', 'App\Http\Controllers\Controller_city@update');
    //delete city
    Route::post('/city/delete', 'App\Http\Controllers\Controller_city@delete');
    //get filtered city
    Route::get('/cities', 'App\Http\Controllers\Controller_city@filters');
});

//Controller_branch route
Route::controller(Controller_branch::class)->group(function () {
    //insert new branch
    Route::post('/branch/add', 'App\Http\Controllers\Controller_branch@store');
    //update branch
    Route::post('/branch/update', 'App\Http\Controllers\Controller_branch@update');
    //delete branch
    Route::post('/branch/delete', 'App\Http\Controllers\Controller_branch@delete');
    //get filtered branch 
    Route::get('/branches', 'App\Http\Controllers\Controller_branch@filters');
});

//Controller_district route
Route::controller(Controller_district::class)->group(function () {
    //insert new district
    Route::post('/district/add', 'App\Http\Controllers\Controller_district@store');
    //update district
    Route::post('/district/update', 'App\Http\Controllers\Controller_district@update');
    //delete district
    Route::post('/district/delete', 'App\Http\Controllers\Controller_district@delete');
    //get filtered district
    Route::get('/districts', 'App\Http\Controllers\Controller_district@filters');
});

//Controller_village route
Route::controller(Controller_village::class)->group(function () {
    //insert new village
    Route::post('/village/add', 'App\Http\Controllers\Controller_village@store');
    //update village
    Route::post('/village/update', 'App\Http\Controllers\Controller_village@update');
    //delete village
    Route::post('/village/delete', 'App\Http\Controllers\Controller_village@delete');
    //get filtered village
    Route::get('/villages', 'App\Http\Controllers\Controller_village@filters');
});

//Controller_user route
Route::controller(Controller_user::class)->group(function () {
    //insert new user
    Route::post('/user/add', 'App\Http\Controllers\Controller_user@store');
    //update user
    Route::post('/user/update', 'App\Http\Controllers\Controller_user@update');
    //delete user
    Route::post('/user/delete', 'App\Http\Controllers\Controller_user@delete');
    //get filtered users
    Route::get('/users', 'App\Http\Controllers\Controller_user@filters');
});

//Controller_hris_role route
Route::controller(Controller_hris_role::class)->group(function () {
    //insert new hris_role
    Route::post('/hris_role/add', 'App\Http\Controllers\Controller_hris_role@store');
    //update hris_role
    Route::post('/hris_role/update', 'App\Http\Controllers\Controller_hris_role@update');
    //delete hris_role
    Route::post('/hris_role/delete', 'App\Http\Controllers\Controller_hris_role@delete');
    //get filtered hris_roles
    Route::get('/hris_roles', 'App\Http\Controllers\Controller_hris_role@filters');
});

//Controller_pugindo_role route
Route::controller(Controller_pugindo_role::class)->group(function () {
    //insert new pugindo_role
    Route::post('/pugindo_role/add', 'App\Http\Controllers\Controller_pugindo_role@store');
    //update pugindo_role
    Route::post('/pugindo_role/update', 'App\Http\Controllers\Controller_pugindo_role@update');
    //delete pugindo_role
    Route::post('/pugindo_role/delete', 'App\Http\Controllers\Controller_pugindo_role@delete');
    //get filtered pugindo_roles
    Route::get('/pugindo_roles', 'App\Http\Controllers\Controller_pugindo_role@filters');
});

//Controller_portal_role route
Route::controller(Controller_portal_role::class)->group(function () {
    //insert new portal_role
    Route::post('/portal_role/add', 'App\Http\Controllers\Controller_portal_role@store');
    //update portal_role
    Route::post('/portal_role/update', 'App\Http\Controllers\Controller_portal_role@update');
    //delete portal_role
    Route::post('/portal_role/delete', 'App\Http\Controllers\Controller_portal_role@delete');
    //get filtered portal_roles
    Route::get('/portal_roles', 'App\Http\Controllers\Controller_portal_role@filters');
});

//Controller_company route
Route::controller(Controller_company::class)->group(function () {
    //insert new company
    Route::post('/company/add', 'App\Http\Controllers\Controller_company@store');
    //update company
    Route::post('/company/update', 'App\Http\Controllers\Controller_company@update');
    //delete company
    Route::post('/company/delete', 'App\Http\Controllers\Controller_company@delete');
    //get filtered companies
    Route::get('/companies', 'App\Http\Controllers\Controller_company@filters');
});
