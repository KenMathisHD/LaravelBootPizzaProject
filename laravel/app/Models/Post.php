<?php

namespace App\Models;
// we have to set namespace to App so that we can easily use this model throughout our application and easily get it loaded and so on

class Post
{
    public function getPosts($session)
    {
        if (!$session->has('posts')) {
            $this->createDummyData($session);
            // Here, we're creating an if statement to populate the session with dummy data if the session does not have the posts key 
        }
        return  $session->get('posts');
        // We want to accesss our session here
        // We cant use dependcy injection in our post class because it doesn't have access to the laravel service contada (?)
        // we can use a facade, or we can pass a session here as an argument and inject it in the controller, and then pass it to this method

        // We're using the second method, so we're accessing the session in the return, then using the get method to access all our posts - we'll need a key in this session that holds all our posts
    }
    // This function will allow us to access this method to retrieve post information, from our controller  

    private function createDummyData($session)
    {
        $posts = [
            [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel'
            ],
            [
                'title' => 'Something Else',
                'content' => 'Some other content'
            ]
        ];
        $session->put('posts', $posts);
        // To populate our session, we're gonna pass it into the function
        // And then we'll put the dummydata in our session using the puth method and store the data
        // We store the data using a key called posts, since this is the key we defined in our getPosts function, and is the key we'll use later on
        // And then we store them using the dollar sign posts variable
    }
    // When we first launch our application, when we don't have a session or don't have any data in the session, our getPosts function will be empty
    // So, we're creating this private getDummyData function here to populate our session with some dummy data



}
