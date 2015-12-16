<?php
Route::controller('auth/password', 'Auth\PasswordController', [
    'getEmail' => 'auth.password.email',
    'getReset' => 'auth.password.reset'
]);

Route::controller('auth', 'Auth\AuthController', [
    'getLogin' 	=> 'auth.login',
    'getLogout' => 'auth.logout'
]);
Route::get('/backend', function ()
{
	return redirect()->route('auth.login');
});

Route::get('backend/users/{users}/confirm', ['as' => 'backend.users.confirm', 'uses' => 'Backend\UsersController@confirm']);
Route::resource('backend/users', 'Backend\UsersController', ['except' => ['show']]);

Route::get('backend/pages/{pages}/confirm', ['as' => 'backend.pages.confirm', 'uses' => 'Backend\PagesController@confirm']);
Route::resource('backend/pages', 'Backend\PagesController', ['except' => ['show']]);

Route::get('backend/posts/{posts}/confirm', ['as' => 'backend.posts.confirm', 'uses' => 'Backend\PostsController@confirm']);
Route::resource('backend/posts', 'Backend\PostsController', ['except' => ['show']]);

Route::get('backend/dashboard', [
    'as' 	=> 'backend.dashboard',
    'uses' 	=> 'Backend\DashboardController@index'
]);
