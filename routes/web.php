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


// Auth::routes();


Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('login123123123123', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('login', 'Auth\LoginController@login')->name('login');

// Info pages
Route::view('about', 'pages.about')->name('page.about');
Route::view('contact', 'pages.contact')->name('page.contact');


// Front view Category
Route::resource('category', 'Category\CategoriesController')
    ->only(['index', 'show']);

// Front view: List of Posts
Route::get('post', 'Post\PostsController@index');

//Tags
Route::resource('tag', 'Tag\TagController')
    ->only(['index', 'show']);

// Front view: Single Post
Route::get('{post}/0000{post_id}', 'Post\PostsController@show')->name('post.front.show');

Route::get('/', 'HomepageController@index');


// Admin user
Route::prefix('admin123123')
    ->middleware('auth')
    ->group(function () {

        // Dashboard admin user
        Route::view('', 'user-admin/dashboard')->name('dashboard');

        // Logout
        Route::post('/logout',
            'Auth\LoginController@logout')->name('logout');


        // Posts
        // User Posts: Index
        Route::resource('post', 'User\UserPostsController')
            ->only(['index']);

        // User Posts: Create, Store, Edit, Update, Destroy
        Route::resource('post', 'Post\PostsController')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);


        // Categories
        // User Categories Index
        Route::resource('category', 'User\UserCategoriesController')
            ->only(['index']);

        //Tags
        Route::resource('tag', 'Tag\TagController')
            ->only(['create', 'edit', 'store', 'update', 'destroy']);

        //User tags controller
        Route::resource('tag', 'User\UserTagsController')
            ->only('index');

        // Create, Store, Edit, Update, Destroy Category
        Route::resource('category', 'Category\CategoriesController')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);


        // Create, Store, Edit, Update, Destroy Category
        Route::view('images-error', 'user-admin/images-error')->name('error.images');

        Route::delete('remove-error-images', 'Post\PostImagesController@removeErrorImages')
            ->name('error.images.remove');


        // Users
        // User edit & Update
        Route::resource('user', 'User\UsersController')
            ->only([
                'edit', 'update'
            ]);

    });





