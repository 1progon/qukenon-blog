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

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/login123123123123', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('/login', 'Auth\LoginController@login')->name('login');

// Info pages
Route::view('/about', 'pages.about')->name('page.about');
Route::view('/contact', 'pages.contact')->name('page.contact');


Route::get('/admin123123', 'HomeController@index')->name('home');


// Front view Category
Route::resource('category', 'CategoriesController')
    ->only(['index', 'show']);

// Front view: List of Posts
Route::get('post', 'PostsController@index');
// Front view: Single Post
Route::get('{post}.0000{post_id}', 'PostsController@show')->name('post.front.show');

Route::view('/', 'homepage');


// Admin user
Route::prefix('admin123123')
    ->middleware('auth')
    ->group(function () {

        // Dashboard admin user
        Route::view('/', '/user-admin/dashboard')->name('dashboard');

        // Logout
        Route::post('/logout',
            'Auth\LoginController@logout')->name('logout');


        // Posts
        // User Posts: Index
        Route::resource('post', 'UserPostsController')
            ->only([
                'index'
            ]);

        // User Posts: Create, Store, Edit, Update, Destroy
        Route::resource('post', 'PostsController')
            ->only([
                'create', 'store', 'edit', 'update', 'destroy'
            ]);


        // Categories
        // User Categories Index
        Route::resource('category', 'UserCategoriesController')
            ->only([
                'index'
            ]);


        // Create, Store, Edit, Update, Destroy Category
        Route::resource('category', 'CategoriesController')
            ->only([
                'create', 'store', 'edit', 'update', 'destroy'
            ]);


        // Create, Store, Edit, Update, Destroy Category
        Route::view('images-error', 'user-admin/images-error')->name('error.images');

        Route::delete('remove-error-images', 'PostImagesController@removeErrorImages')
            ->name('error.images.remove');


        // Users
        // User edit & Update
        Route::resource('user', 'UsersController')
            ->only([
                'edit', 'update'
            ]);

    });



