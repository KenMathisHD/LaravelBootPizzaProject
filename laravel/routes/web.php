<?php

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
    return view('blog.index');
})->name('blog-index');
//assigning names to our routes so that, if the route path changes, we don't need to update this on each page

// use get to load a single page - to get a resource
// in get, we define two arguments - the path in your url, and the code that should get executed whenever a request reaches this path
//this route is going to a post
//we're passing the post id in those curly braces
Route::get('post/{id}', function () {
    return view('blog.post');
})->name('blog.post');

Route::get('about', function () {
    return view('other.about');
})->name('other.about');

// grouping routes below
// the group method allows you to pass an array as the first argument
//one option you can define is prefix
//prefix configuration takes 1 value assigned using arrow notation
//that value you give it is the prefix that all the routes in the group will have
Route::group(['prefix' => 'admin'], function () {

    Route::get('', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get('/create', function () {
        return view('admin.create');
    })->name('admin.create');
    
    // creating a post route below
    Route::post('create', function () {
        return "It works!";
    })->name('admin.createP');
    
    Route::get('edit/{id}', function () {
        return view('admin.edit');
    })->name('admin.edit');
    
    Route::post('edit', function () {
        return "It works!";
    })->name('admin.editP');

});