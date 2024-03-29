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

Route::prefix('blog')->group(function () {
    Route::view('404', 'errors.404')->name('error404');

//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
//Route::post('register', 'Auth\RegisterController@register')->name('register');

    Route::get('login123123123123', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('login', 'Auth\LoginController@login')->name('login');

// Info pages
    Route::view('about', 'pages.about')->name('pages.about');
    Route::view('contact', 'pages.contact')->name('pages.contact');


// Front view Category
    Route::resource('categories', 'Category\CategoriesController')
        ->only(['index', 'show'])
        ->names(['index' => 'categories.front.index', 'show' => 'categories.front.show']);


// Front view: List of Posts
    Route::get('posts', 'Post\PostsController@index')->name('posts.front.index');
// Front view: Single Post
    Route::get('{post}/0000{post_id}', 'Post\PostsController@show')->name('posts.front.show');


//Tags
    Route::resource('tags', 'Tag\TagController')
        ->only(['index', 'show'])
        ->names(['index' => 'tags.front.index', 'show' => 'tags.front.show']);;


    Route::get('/', 'HomepageController@index');

// Admin user
    Route::prefix('admin123123')
        ->middleware('auth')
        ->group(function () {
            // Dashboard admin user
            Route::view('', 'user-admin/dashboard')->name('dashboard');

            // Logout
            Route::post(
                '/logout',
                'Auth\LoginController@logout'
            )->name('logout');


            // Posts
            // User Posts: Index
            Route::resource('posts', 'User\UserPostsController')
                ->only(['index']);

            // User Posts: Create, Store, Edit, Update, Destroy
            Route::resource('posts', 'Post\PostsController')
                ->only(['create', 'store', 'edit', 'update', 'destroy']);


            // Categories
            // User Categories Index
            Route::resource('categories', 'User\UserCategoriesController')
                ->only(['index']);

            // Create, Store, Edit, Update, Destroy Category
            Route::resource('categories', 'Category\CategoriesController')
                ->only(['create', 'store', 'edit', 'update', 'destroy']);

            //Tags
            Route::resource('tags', 'Tag\TagController')
                ->only(['create', 'edit', 'store', 'update', 'destroy']);

            //User tags controller
            Route::resource('tags', 'User\UserTagsController')
                ->only('index');


            Route::view('images-error', 'user-admin/images-error')->name('error.images');

            Route::delete('remove-error-images', 'Post\PostImagesController@removeErrorImages')
                ->name('error.images.remove');


            // Users
            // User edit & Update
            Route::resource('users', 'User\UsersController')
                ->only(['edit', 'update']);
        });
});





