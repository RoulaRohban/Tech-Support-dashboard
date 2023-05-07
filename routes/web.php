<?php

use App\Http\Middleware\SuperAdminMiddleware;
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

Route::get('/', function () {
    return redirect(route('customers.login'));
});

Route::group( ['middleware' => 'auth'], function() {
    Route::get('supports','SupportController@index')->name('tech-supports.index');
    Route::put('supports/{id}','SupportController@update')->name('tech-supports.update');
    Route::get('supports/edit/{id}','SupportController@edit')->name('tech-supports.edit');
    Route::get('supports/{id}','SupportController@show')->name('tech-supports.show');
    Route::resource('users','UserController')->middleware([SuperAdminMiddleware::class]);
    Route::get('users/{id}/edit/reset-password','UserController@resetPasswordForm')->name('users.form.reset_password')->middleware([SuperAdminMiddleware::class]);
    Route::put('users/{id}/reset-password','UserController@resetPassword')
        ->name('users.reset_password')
        ->middleware([SuperAdminMiddleware::class]);
    Route::resource('categories','CategoryController');
    Route::resource('customers','CustomerController');
    Route::get('customers/{id}/edit/reset-password','CustomerController@resetPasswordForm')->name('customers.form.reset_password');
    Route::put('customers/{id}/reset-password','CustomerController@resetPassword')->name('customers.reset_password');

});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});


Route::namespace('CustomerAuth')->group(function(){

    //Login Routes
    Route::get('/clients/login','LoginController@showLoginForm')->name('customers.login');
    Route::post('/clients/login','LoginController@login');
    Route::get('/clients/logout','LoginController@logout')->name('customers.logout');
});

Route::group( ['middleware' => 'auth:customer'], function() {
Route::get('supports/create','SupportController@create')->name('tech-supports.create');
Route::post('supports','SupportController@store')->name('tech-supports.store');
});
