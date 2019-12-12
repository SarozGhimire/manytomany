<?php

use App\Role;
use App\User;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create', function(){

	$user = User::find(1);

	$user->roles()->save(new Role(['name'=>'administrator']));

});

Route::get('/read', function(){

	$user = User::findOrFail(1);

	foreach ($user->roles as $role) {
		
		echo $role->name;
	}

});


Route::get('/update', function(){

	$user = User::findOrFail(1);

	if($user->has('roles')){

		foreach ($user->roles as $role) {
		
			if ($role->name == 'administrator') {
			
				$role->name = 'subscriber';

				$role->save();
			}
		}
	}

});


Route::get('/delete', function(){

	$user = User::findOrFail(1);

	foreach ($user->roles as $role) {
		
		$role->whereId(1)->delete();
	}

});


Route::get('/attach', function(){

	$user = User::findOrFail(1);

	$user->roles()->attach(2);

});

Route::get('/detach', function(){

	$user = User::findOrFail(1);

	$user->roles()->detach(2);

});

Route::get('/sync', function(){

	$user = User::findOrFail(1);

	$user->roles()->sync([2,3]);

});