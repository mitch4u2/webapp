<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/service', 'PagesController@service');
Route::resource('posts','PostsController');



// Route::get('/', function () {
//     return view('welcome');
    
// });

// Route::get('/about', function () {
//     return View('pages.about');
// });

// Route::get('/testtwig', function () {
//     return View::make('hello');
// });

// about page
// dynamic route
// Route::get('/users/{id}/{name}', function ($id,$name) {
//     return 'this is your id ' .$id.' and this is your name '.$name;
// });
