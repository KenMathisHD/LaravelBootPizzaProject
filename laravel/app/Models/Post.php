<?php

namespace App\Models;
// we have to set namespace to App so that we can easily use this model throughout our application and easily get it loaded and so on


use Illuminate\Database\Eloquent\Model;
// Here, we're intructing the Post model to use the Eloquent model so we can extend it in the post class below

class Post extends Model
{

    protected $fillable = ['title', 'content'];
    // this is a protected porperty named $fillable
    // this is a protected name laravel will recognize, and it is an array 
    // We're specifying a couple of string in this array, where each string refers to a database field we want to make mass assignable - i.e. assignable dynamically(?)


    public function likes() {
        return $this->hasMany('\App\Models\Like', 'post_id');
        // this points to the like model we have set up in our models folder here
        // Here' we're also adjusting the name of the database field to post_id. It's not strictly necessary, but I want to show this so I know how to do it in the future. Also, I think it helps keep better track of what things are associated with what bits of code

    }

    public function tags() {
        return $this->belongsToMany('\App\Models\Tag', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
        // this is for a many to many relationship - 1 post can have many tags, and 1 tag can go to many posts
        // We need to make sure to chain withTimestamps if we want to make sure that the timestamps in our pivot table also get filled out when a new relationship entry is created
    
        // this here - this always gives us back a laravel collection - i.e. a collection of tags



        // to break this down a bit easier, belongsToMany works like this:
        //      -The first (or only) thing you pass is the name of the related model class
        //          In our case, our related model class is Tag, so we pass it that (or rather, the location)
        //      -The second argument you pass, if any, will be the name of the intermediate table
        //          The intermediate table is the table that keeps track of what belongs to who - i.e. user_id 123 has role_id 431 and user_id 124 has role_id 431 and whatnot
        //      -The third argument you pass will be the name of the key that you're using for the model class where you're defining the relationship
        //          So if you're defining the relationship on the user model class, and you're keeping track with the user_id, that would be user_id
        //      -The fourth argument you pass will be the name of the key that you're using for the model class you're joining to
        //          So if you're relationship is defined on the user model class, and you're joining to the roles model class, and you're keeping track with the role_id, then you would pass role_id

    }

    public function setTitleAttribute($value) {
        // a mutator function/method name will always start with set and will always end with Attribute
        // the thing between set and attribute is the name of the field we want to change - it will always be uppercase for the first letter
        // because we set it up this way, this method will automatically always be called whenever we set the title property
        // another cool thing, Laravel, while making sure this runs automatically, also automatically saves the value to the database after running this mutator method
        $this->attributes['title'] = strtolower($value);
        // all this mutator does is convert the title to all lowercase letters
    }
    // this is a mutator function - mutators are always only set up in the model they're used for


    public function getTitleAttribute($value) {
        // an accessor function/method name will always start with get and will always end with Attribute
        // the thing between get and attribute is the name of the field we want to get - it will always be uppercase for the first letter
        // because we set it up this way, this method will automatically always be called whenever we get/access/fetch the title property from the database
        // for an accessor, we have to return something instead of grab and save something
        return ucwords($value);
    }
    // this is an accessor method/function








    // The below is what we would use for storing data in and pulling data from the session. 
    // Since we're now using a database and the controller together, we no longer need the below
    // However, I'm keeping it for reference in the future since this is a learning project

    // // by extending the Eloquent Model, we allow the Post class to access all of the features from the Eloquent model  
    // public function getPosts($session)
    // {
    //     if (!$session->has('posts')) {
    //         $this->createDummyData($session);
    //         // Here, we're creating an if statement to populate the session with dummy data if the session does not have the posts key 
    //     }
    //     return $session->get('posts');
    //     // We want to accesss our session here
    //     // We cant use dependcy injection in our post class because it doesn't have access to the laravel service contada (?)
    //     // we can use a facade, or we can pass a session here as an argument and inject it in the controller, and then pass it to this method

    //     // We're using the second method, so we're accessing the session in the return, then using the get method to access all our posts - we'll need a key in this session that holds all our posts
    // }
    // // This function will allow us to access this method to retrieve post information, from our controller  

    // public function getPost($session, $id) {
    //     if (!$session->has('posts')) {
    //         $this->createDummyData($session);
    //     }
    //     return $session->get('posts')[$id];

    //     // this method allows us to retrieve a single post
    // }

    // public function addPost($session, $title, $content) {
    //     if (!$session->has('posts')) {
    //         $this->createDummyData($session);
    //     }
    //     $posts = $session->get('posts');
    //     array_push($posts, ['title' => $title, 'content' => $content]);
    //     $session->put('posts', $posts);

    //     // this method allows us to add a new post to the session array. All it does is push a new post on to the array of posts that we get from our session

    // }

    // public function editPost($session, $id, $title, $content) {
    //     // if (!$session->has('posts')) {
    //     //     $this->createDummyData($session);
    //     // }
    //     // return $session->get('posts')[$id];
    //     $posts = $session->get('posts');
    //     $posts[$id] = ['title' => $title, 'content' => $content];
    //     $session->put('posts', $posts);

    //     // this method allows us to edit posts
    //     // it does this by grabbing a specific post from the array of posts, using the id to grab it
    //     // after editing, it takes the post with the new information and adds it to the posts array  
    // }

    // private function createDummyData($session)
    // {
    //     $posts = [
    //         [
    //             'title' => 'Learning Laravel',
    //             'content' => 'This blog post will get you right on track with Laravel'
    //         ],
    //         [
    //             'title' => 'Something Else',
    //             'content' => 'Some other content'
    //         ]
    //     ];
    //     $session->put('posts', $posts);
    //     // To populate our session, we're gonna pass it into the function
    //     // And then we'll put the dummydata in our session using the puth method and store the data
    //     // We store the data using a key called posts, since this is the key we defined in our getPosts function, and is the key we'll use later on
    //     // And then we store them using the dollar sign posts variable
    // }
    // // When we first launch our application, when we don't have a session or don't have any data in the session, our getPosts function will be empty
    // // So, we're creating this private getDummyData function here to populate our session with some dummy data



}
