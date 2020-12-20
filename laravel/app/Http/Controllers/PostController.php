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
        // We have to pas the session here, so we'll use dependency injection to do so at the setupo of our function. 
        // We can use dependency injection here in the controller, because Laravel loads the controller in a way where it has access tyo 
        return view('blog.index', ['posts' => $post]);
        // With this post model, we can return a view. The view we want to return is our blog.index view
        // We're going to pass some data as well, which is our posts variable, which we assign to dallar sign post
        // In order to do that, we have to create it by using our post model and calling get posts  
    }
    //in this controller, we create methods that are called actions. These are called actions because we will link them up in the routes file and therefore connect our routes to certain methods in this controller, which should get executed

}
