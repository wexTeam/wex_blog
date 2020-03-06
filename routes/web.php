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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});
Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'user',
    'namespace'     => 'User'
], function ()
{
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard');
    Route::get('/profile-setting', 'UserController@profileSetting')->name('user.profile');
    Route::post('/profile-setting', 'UserController@updateProfile')->name('user.profile');
    Route::get('/cache-clear', 'UserController@configCache')->name('user.cache_clear');

    Route::get('/notifications', 'UserController@notifications')->name('user.notifications');

});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


});
Route::group([
    'middleware'    => ['auth:admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');



    //Setting Routes
    Route::resource('setting','SettingController');
    Route::get('/cache-clear', 'AdminController@configCache')->name('admin.cache_clear');

    //User Routes
    Route::resource('users','UsersController');
    Route::get('users/edit/{id}', 'UsersController@edit')->name('admin-edit');
    Route::post('get-users', 'UsersController@getUsers')->name('admin.getUsers');
    Route::post('get-user', 'UsersController@userDetail')->name('admin.getUser');
    Route::get('users/delete/{id}', 'UsersController@destroy')->name('user-delete');
    Route::post('delete-selected-users', 'UsersController@DeleteSelectedUsers')->name('delete-selected-users');
    Route::get('edit-profile/{id}', 'UsersController@show')->name('edit-profile');

    //User Routes
    Route::resource('messages','MessageController');
    Route::get('messages/edit/{id}', 'MessageController@edit')->name('admin.edit_message');
    Route::post('get-messages', 'MessageController@getMessages')->name('admin.getMessages');
    Route::post('get-message', 'MessageController@messageDetail')->name('admin.getMessage');
    Route::get('messages/delete/{id}', 'MessageController@destroy')->name('admin.deleteMessage');
    Route::post('delete-selected-messages', 'MessageController@deleteSelectedMessages')->name('admin.deleteSelectedMessages');

    //Categories Routes
    Route::resource('categories','CategoriesController');
    Route::post('get-categories', 'CategoriesController@getCategories')->name('admin.getCategories');
    Route::post('get-category', 'CategoriesController@categoryDetail')->name('admin.getCategory');
    Route::get('categories/delete/{id}', 'CategoriesController@destroy');
    Route::post('delete-selected-categories', 'CategoriesController@deleteSelectedCategories')->name('admin.deleteSelectedCategories');

    Route::resource('sub-categories','CategoriesController');
    Route::post('get-sub-categories', 'CategoriesController@getSubCategories')->name('admin.getSubCategories');
    Route::post('get-sub-category', 'CategoriesController@subCategoryDetail')->name('admin.getSubCategory');
    Route::get('sub-category/delete/{id}', 'CategoriesController@destroy');
    Route::post('delete-selected-sub-categories', 'CategoriesController@deleteSelectedSubCategories')->name('admin.deleteSelectedSubCategories');
});
