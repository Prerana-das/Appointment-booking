<?php

use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;

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

Route::prefix('app')->middleware([AdminCheck::class])->group(function(){
   
    // Route::post('/upload', 'AdminController@upload');
    Route::post('/delete_image', 'AdminController@deleteImage');
    Route::post('/create_category', 'AdminController@addCategory');
    Route::get('/get_category', 'AdminController@getCategory');
    Route::get('/get_all_categoryy', 'AdminController@get_all_categoryy');
    Route::post('/edit_category', 'AdminController@editCategory');
    Route::post('/delete_category', 'AdminController@deleteCategory');
    Route::post('/create_user', 'AdminController@createUser');
    Route::get('/get_users', 'AdminController@getUsers');
    Route::post('/edit_user', 'AdminController@editUser');
    Route::post('/admin_login', 'AdminController@adminLogin');

    Route::get('/get_all_slot','SlotController@get_all_slot');
    Route::get('/get_all_booked_slot','SlotController@get_all_booked_slot');
    Route::post('/add_slot','SlotController@add_slot');
    Route::post('/delete_slot', 'SlotController@delete_slot');
    Route::post('/edit_slot', 'SlotController@edit_slot'); 
    Route::get('/sortByCategory','SlotController@sortByCategory');

    Route::post('/delete_booked_slot', 'SlotController@delete_booked_slot');
    Route::get('/get_booking_details','BookingController@get_booking_details');
    Route::post('/delete_booking', 'BookingController@delete_booking');
});


Route::get('/get_all_category', 'AdminController@get_all_category');
Route::get('/get_first_category','AdminController@get_first_category');
Route::get('/getslots', 'SlotController@getslots');
Route::get('/get_all_slot_list','SlotController@get_all_slot_list');
Route::post('/add_booking','BookingController@add_booking');




Route::get('/logout', 'AdminController@logout');
Route::get('/', 'AdminController@index');
Route::any('{slug}', 'AdminController@index');
