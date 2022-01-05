<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_detailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AluminiController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Event_JoinController;
// use App\Http\Controllers\User_SkillController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/signup', [UsersController::class, 'signup']);
Route::delete('/signup/{id}', [UsersController::class, 'destroy']);
Route::get('/user', [UsersController::class, 'index']);

Route::get('/user/{id}', [UsersController::class, 'show']);
Route::put('/user/{id}', [UsersController::class, 'update']);
Route::get('/signup', [UsersController::class, 'index']);
Route::put('/updateUser/{id}', [UsersController::class, 'updatePassword']);

Route::get('/search',[UsersController::class, 'search']);
Route::get('/signup', [UsersController::class, 'index']);




//User_detail
Route::get('/user_details', [User_detailController::class, 'index']);
Route::post('/user_details', [User_detailController::class, 'store']);
Route::get('/user_details/{id}', [User_detailController::class, 'show']);
Route::put('/user_details/{id}', [User_detailController::class, 'update']);
Route::put('/updateProfile/{id}', [User_detailController::class, 'updateProfile']);
Route::post('/signin', [UsersController::class, 'signin']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/signout', [UsersController::class, 'signout']);
});

// get country from storage
Route::get('/countries', [CountryController::class, 'getCountries']);
// all alumini
Route::get('/alumini', [AluminiController::class, 'getAlu']);



//Companies
Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::get('/company/{id}', [CompanyController::class, 'showCompany']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);
Route::put('/updateProfileCompany/{id}', [CompanyController::class, 'updateProfileCompany']);


//events
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);



//eventjoins
Route::get('/eventjoins', [Event_JoinController::class, 'index']);
Route::post('/eventjoins', [Event_JoinController::class, 'store']);
Route::get('/eventjoins/{id}', [Event_JoinController::class, 'show']);
Route::put('/eventjoins/{id}', [Event_JoinController::class, 'update']);
Route::delete('/eventjoins/{id}', [Event_JoinController::class, 'destroy']);

//Skill
Route::get('/skills', [SkillController::class, 'index']);
Route::post('/skills', [SkillController::class, 'store']);
Route::get('/skills/{id}', [SkillController::class, 'show']);
Route::put('/skills/{id}', [SkillController::class, 'update']);
Route::delete('/skills/{id}', [SkillController::class, 'destroy']);

