<?php

use App\User;
use Illuminate\Support\Facades\Gate;



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
Route::group(['middleware' => 'guest'] , function(){
	Route::get('/', function () {
		 return view('auth/login'); 
     });
});

Route::get('/test' , function(){

	$user = User::first();

	return $user->user_status;
});


Auth::routes();
//-----

Route::group(['middleware' => 'auth'], function(){
	//home Controller
	Route::get('/dashboard', 'HomeController@admin');
	Route::get('/profile', 'HomeController@profile');
	Route::post('profile', 'HomeController@update_avatar');

	//employees
	Route::get('employees', 'UserController@index')->name('show_users');
	Route::get('employees/getempdata', 'UserController@getempdata')->name('employee.getempdata');

	Route::post('employees/postempdata', 'UserController@postempdata')->name('employee.postempdata');
	Route::post('employees/activation' , 'UserController@activation')->name('employee.activation');
	Route::get('employees/fetchempdata', 'UserController@fetchempdata')->name('employee.fetchempdata');

	//patients
	Route::get ('transactions','PatientController@searchpatient')->name('searched_patient');

	Route::group(['prefix' => 'patients'] , function(){
		Route::get ('/', 'PatientController@index')->name('show_patient');
		Route::get ('getdata'   , 'PatientController@getdata')->name('patient.getdata');
		Route::post('postdata'  , 'PatientController@postdata')->name('patient.postdata');
		Route::get ('fetchdata' , 'PatientController@fetchdata')->name('patient.fetchdata');
		Route::post('search'    ,'PatientController@search')->name('patient.search');

	});

	// patients transaction

	Route::group(['prefix' => 'transaction' ,'as' => 'transaction.'] , function(){
		Route::post('postdata', 'TransactionController@postdata')->name('postdata');
		Route::get ('getdata' , 'TransactionController@getdata')->name('getdata');
		Route::get ('find-data', 'TransactionController@findData')->name('find-data');
	});


	 
	Route::get('/medicines', 'MedicineController@getMedicines');
	Route::get('/medicines/history', 'MedicineController@history');
	Route::post('/med_save', 'MedicineController@save');
	Route::patch('/update_med/{id}', ['as' => 'medicine.update', 'uses' => 'MedicineController@update']);
	Route::delete('/delete_med/{id}', ['as' => 'medicine.delete', 'uses' => 'MedicineController@delete']);


	//laboratories
	Route::get('laboratories', 'LaboratoryController@index')->name('show_laboratory');
	Route::get('laboratories/getdata', 'LaboratoryController@getdata')->name('laboratory.getdata');
	Route::post('laboratories/postdata', 'LaboratoryController@postdata')->name('laboratory.postdata');
	Route::get('laboratories/fetchdata', 'LaboratoryController@fetchdata')->name('laboratory.fetchdata');

});

// Route::get('laboratories', 'LaboratoryController@getLaboratories');

// Route::get('laboratories/getdata', 'LaboratoryController@getdata')->name('laboratory.getdata');
 
// Route::post('/lab_save', 'LaboratoryController@save');
 
// Route::patch('/update_lab/{id}', ['as' => 'laboratory.update', 'uses' => 'LaboratoryController@update']);
 
// Route::delete('/delete_lab/{id}', ['as' => 'laboratory.delete', 'uses' => 'LaboratoryController@delete']);



// Route::get('patients_data', 'PatientController@index');
// Route::get('patient/fetchdata', 'PatientController@fetchdata')->name('patient.fetchdata');

// Route::get('patients', 'PatientController@getPatients');
 
// Route::post('/save', 'PatientController@save');
 
// Route::patch('/update/{id}', ['as' => 'patient.update', 'uses' => 'PatientController@update']);
 
// Route::delete('/delete/{id}', ['as' => 'patient.delete', 'uses' => 'PatientController@delete']);

//medicine

// Route::get('employees_data', 'EmployeeController@index');
 
// Route::get('employees', 'EmployeeController@getEmployees');
 
// Route::post('/emp_save', 'EmployeeController@save');
 
// Route::patch('/update_emp/{id}', ['as' => 'employees.update', 'uses' => 'EmployeeController@update']);
 
// Route::delete('/delete_emp/{id}', ['as' => 'employees.delete', 'uses' => 'EmployeeController@delete']);





// Route::get('/sample','HomeController@admin')->name('sample');

// /**
//      * Register the typical authentication routes for an application.
//      *
//      * @return void
//      */
//     public function auth()
//     {
//         // Authentication Routes...
//         $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//         $this->post('login', 'Auth\LoginController@login');
//         $this->post('logout', 'Auth\LoginController@logout')->name('logout');
//         // Registration Routes...
//         $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//         $this->post('register', 'Auth\RegisterController@register');
//         // Password Reset Routes...
//         $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//         $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//         $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//         $this->post('password/reset', 'Auth\ResetPasswordController@reset');
//     }