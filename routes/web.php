<?php

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route to all jobs
Route::get('/', [JobController::class, 'index']);

//show create form
Route::get('/jobs/create',[JobController::class, 'create'])->middleware('auth');

//stores listing data
Route::post('/jobs', [JobController::class,'store'])->middleware('auth');

//show edit form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth');

//edit form submission
Route::put('/jobs/{job}', [JobController::class, 'update'])->middleware('auth');

//delete a gig
Route::delete('/jobs/{job}',[JobController::class,'delete'])->middleware('auth');

//managing the gigd
Route::get('/jobs/manage', [JobController::class, 'manage'])->middleware('auth');

//route to a single job
Route::get('/jobs/{job}', [JobController::class,'show']);

//route to registration form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

//route to saving new user
Route::post('/users', [UserController::class,'store']);

//route to logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//route to login page
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//route to login user
Route::post('/users/authenticate',[UserController::class,'authenticate']);

















//Route::get('/hey', function(){
//    return response('<h1>Hey there</h1>',200)
//        ->header('Content-Type', 'text/plain')
//        ->header('foo','bar');
//});

//routing using wildcards
//Route::get('/posts/{id}',function($id){
//    //debugging
//    ddd($id);
//    return response('Post ' . $id);
//    //adding a constraint
//})->where('id','[0-9]+');

//routing with http requests
//Route::get('/search', function(Request $request){
//    return($request->name . ' ' . $request->city);
//});