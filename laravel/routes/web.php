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
Route::get('post/{id}', function ($id) {
    if ($id == 1) {
        $post = [
            'title' => 'Learning Laravel',
            'content' => 'This blog post will get you right on track with Laravel!'
        ];
    }
    else {
        $post = [
            'title' => 'Something else',
            'content' => 'This displays some different content'
        ];
    }
    return view('blog.post', ['post' => $post]);
    // the second argument we're passing here is an associative array, which allows us to pass data to the view. This data can then be used in said view to dynamically output it there
    // We're creating a string variable named post in our argument amd associating it with the dollar sign post variable from our if-else block above
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

    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    // creating a post route below
    Route::post('create', function (\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        // (above) we're using direct injection instead of using the request facade because it's apparently better to use direct injection instead of facades when you can
        // What we're doing here is getting access to the request object, and assigning it to the variable dollar sign request

        // We're also validating our data using that direct injection class after the dollar sign request variable, adn assigning it the variable of dollar sign validator
        // This somehow allows us to create our own validation rules using Laravel's built in validator factory unit

        // Below we're creating our own validation rules using the validator factory
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        // We're calling the make method to create a new validator, and it takes two arguments
        // The first argument is the data we want to validate. Here' we're using the data passed by the user. 
        // We don't want to pass the whole request - we just want to pass the data attached to this request, and we'll do so by using the all method. This is a built in method we can use on this built in (?) object, which gives us all the data sent with the request
        // The second argument is an associative array where we specify the rules we want to use. 
        // The structure is as follows
        // The name of the input field we want to validate - in this case title. The names we use for this are the names we assigned to our input fields in our views
        // The next is the values set for the validation rules you want to use - each rule is separated by the or symnbol |  
        // For some of the rules, like min, you have to pass an argument (or arguments) to use. For example, for min, we have to pass the number of minimum characters
        // To do this, we add a colon and then the argument

        // We also need to do something in case validation fails - to do this, we're creating a new variable, dollar sign validation, and assigning it to the validation we created
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
            // if validation fails, we're returning the user to the prior page by using redirect with the back method
            // we're also chaining this with the withErrors method, which tells Laravel to flash some data to the session, but here it will use an error bag(?) that Laravel ships with. We'll pass it our dollar sign validation variable so it sends whatever errors it picks up
        }
        // Then, we'll check to see if validation fails by using an if block and the fails method

        // Go to the errors partials page to see how we're showing the validation errors we receive (if any)


        return redirect()->route('admin.index')->with('info', 'Post created, Title: ' . $request->input('title'));
    })->name('admin.createP');

    Route::get('edit/{id}', function ($id) {
        if ($id == 1) {
            $post = [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel!'
            ];
        }
        else {
            $post = [
                'title' => 'Something else',
                'content' => 'This displays some different content'
            ];
        }
        return view('admin.edit', ['post' => $post]);
    })->name('admin.edit');

    Route::post('edit', function (\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title: ' . $request->input('title'));
        // here, we're using the redirect helper function toi redirect the user upon form submittal
        // We're specifying that we want to redirect them to the admin index page/route
        // We can even temporarily forward some data along the route we're sending the user to using the with method. With does thyis by attaching the information to the existing Laravel session
        // The With method flashes data on the session - meaning it's only available for the next request, i.e. the one sending us the route we've chosen
        // This allows us to output some data in the view of this route the first time we visit, but not after that - like an info message
        // Our first argument is either an array or a string (in this case - the string info)
        // The second argument is the text we want to input - it can be a mixed value (whatever that means)
        // Then we're retrieving the title the user entered by accessing the dollar sign request variable, which is tied to the request object
        // The request object then has a method we can use called input, which allows us to fetch any foreign data
        // The data we're fetching is called title in the form we're fetching it from, so we'll call it the same here. This is now automatically flashed into the session
        // See admin index page for how to retrieve the title
    })->name('admin.editP');
});
