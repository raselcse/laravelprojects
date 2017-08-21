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

// Route::get('/', function () {
    // return view('welcome');
// });

Auth::routes();

Route::get('/', 'PhonebookController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function(){
	// return view('page.home');
// });
Route::get('/about', function(){
	return view('page.about');
});

Route::get('/contacts', function(){
	return view('page.contacts');
});

Route::get('/signature', function(){
	return view('page.signature');
});

Route::post('/signatureupload', 'UploadController@signatureUpload')->name('signature.upload');

Route::resource('phonebooks','PhonebookController');
Route::delete('phonebooksDeleteAll', 'PhonebookController@deleteAll')->name('phonebooks.deleteAll');
Route::get('/myaccount', 'MyaccountController@index')->name('myaccount');
Route::get('/myaccount/edit', 'MyaccountController@edit')->name('myaccount.edit');
Route::get('/myaccount/update/{id}', 'MyaccountController@update')->name('myaccount.update');
Route::post('/contactSearch', 'PhonebookController@search');
Route::get('/contactupload', 'UploadController@index')->name('contactupload');
Route::post('/contactupload/store', 'UploadController@store')->name('contactupload.store');
Route::get('/contactupload/insert', 'UploadController@insertContact');
Route::get('/exports/', 'PhonebookController@exportphonebook')->name('phonebooks.export');
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{   
	Route::resource('adminphonebooks','admin\AdminPhonebookController');
	Route::get('/admin/user', 'UserController@index')->name('admin.user.index');
	Route::get('/admin/user/{id}/show/', 'UserController@show')->name('admin.user.show');
	Route::get('/admin/user/{id}/edit', 'UserController@edit')->name('admin.user.edit');
	Route::post('/admin/user/{id}/update', 'UserController@update')->name('admin.user.update');
	Route::post('/admin/user/{id}/delete', 'UserController@destroy')->name('admin.user.destroy');
	Route::post('/admin/users/delete', 'UserController@destroyAll')->name('admin.users.destroyall');

});

