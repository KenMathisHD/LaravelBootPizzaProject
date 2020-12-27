<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex(Store $session)
    {
        // Thankfully, emmet abbreviation makes entering the direct injection for this pretty easy. Just type in Store, and select the illuminate session thing, and it autofills the class
        // And then we just pass the dollar sign session variable right after it

        // This action should give us an index of all posts
        // In this method (action), we want to use our posts model. To use it, we need to instantiate (?) it
        $post = new Post();
        // here, we create our new variable called post, and we make it a new post object
        // The post object here refers to our post model, which is why we have to add the use App Post namespace import at the top
        $posts = $post->getPosts($session);
        // We have to pass the session here, so we'll use dependency injection to do so at the setupo of our function. 
        // We can use dependency injection here in the controller, because Laravel loads the controller in a way where it has access tyo 
        return view('blog.index', ['posts' => $posts]);
        // With this post model, we can return a view. The view we want to return is our blog.index view
        // We're going to pass some data as well, which is our posts variable, which we assign to dollar sign post
        // In order to do that, we have to create it by using our post model and calling get posts  
    }
    //in this controller, we create methods that are called actions. These are called actions because we will link them up in the routes file and therefore connect our routes to certain methods in this controller, which should get executed



    public function getAdminIndex(Store $session) {
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('admin.index', ['posts' => $posts]);

        // This function does the same as getIndex - it loads all posts to present them, but does it on the admin index view
    }

    public function getPost(Store $session, $id) {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $post]);

        // This function is used for whenever we try to access a sinle post
        // We use this whenever we try to access a single post, like by clicking on read more
        // It fetches this post from the post model and displays it on the blog post view
    }

    public function getAdminCreate() {
        return view('admin.create');

        // All this function does is return the view where the admin creates a new post
    }

    public function getAdminEdit(Store $session, $id) {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);

        // Here, we fetch a single post, and then load the admin edit view, and send the post data to that view where it is displayed
    }

    public function postAdminCreate(Store $session, Request $request) {
        
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        
        // Here, we're adding our validation rules - the same validation rule we added previously. However, because we're doing this in the controller, we can do this a bit easier using some utility methods provided by Laravel
        // We can simply call $this, and then validate, then pass the request object as our first argument, and the validation rules as our second argument
        // We don't even have to check if validation fails - Laravel takes care of that for us here
        
        
        // $post = new Post();
        // $post->addPost($session, $request->input('title'), $request->input('content'));
        // old solution using session storing - new solution using database storage below

        
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        // because we have the protected fillable attribute in our post model, we can pass in our associative array in our new Post declratation 
        // To provide it with the data it needs, we'll assign data from our $request object and use the input method to pull it from the input values on the page 
        // The names we're using for our input methods are just the names assigned to our input fields on the page
        $post->save();
        // this stores the data somehow - I think it's a method that's part of laravel
        
        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    
        // This is the action used whenever the administrator submits the create post form - the same form that gets loaded in the getAdminCreate route
        // That admin create form has a submit button, so whenever the submit button is clicked on the admin create form, this is the function/action that gets triggered
        // All we're doing here is calling the addPost method on the Post model and pass the title and the content to it
        // Afterwards, the user is redirected to the index page, which shows that the post was created, and displays a message saying your posts new title is whatever the new title name is

    }

    public function postAdminUpdate(Store $session, Request $request) {
        
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        
        
        
        $post = new Post();
        $post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post edited, Title is: ' . $request->input('title'));
    
        // postAdminUpdate is pretty much the same as postAdminCreate, except this is for editing the post
        // Here, we're calling the editPost method on our Post model, passing the post ID as well as the new content, and then redirecting the user to the index page where that post edited message is displayed

    }


}
