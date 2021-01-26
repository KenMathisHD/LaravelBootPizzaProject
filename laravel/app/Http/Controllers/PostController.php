<?php

namespace App\Http\Controllers;


use App\Models\Like;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

// use App\Http\Requests;
// use Illuminate\Session\Store;
// use Symfony\Component\Console\Input\Input;
// We are no longer using the session to store data, but I'm keeping these here to show how you would 'activate' the session for use

// When you have an application working off a database, you'll typically want to seed data into it. You can actually use the laravel seeder for this
// The command to make a seeder is php artisan make:seed and then the name for your seeder
// Go to database/seeders to see the seeders we're using



class PostController extends Controller
{
    public function getIndex()
    {
        // Used to contain Store $session when working using data from and storing data in session



        // Thankfully, emmet abbreviation makes entering the direct injection for this pretty easy. Just type in Store, and select the illuminate session thing, and it autofills the class
        // And then we just pass the dollar sign session variable right after it

        // This action should give us an index of all posts
        // In this method (action), we want to use our posts model. To use it, we need to instantiate (?) it
        // $post = new Post();
        // here, we create our new variable called post, and we make it a new post object
        // The post object here refers to our post model, which is why we have to add the use App Post namespace import at the top
        // $posts = $post->getPosts($session);
        // We have to pass the session here, so we'll use dependency injection to do so at the setupo of our function. 
        // We can use dependency injection here in the controller, because Laravel loads the controller in a way where it has access tyo 
        // Old solution that relies on session data - new solution below that uses database data

        // $posts = Post::all();
        // here, we're accessing the post model (not creating a new one) and using the all method
        // this then stores all our posts (i.e. all the information in our posts database) and stores it in our $posts variable


        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        // paginate works just like get, except you can pass it how many posts you want to display on the page - either by hard coding it, or by passing a variable with a dynamic value

        // to load in some laravel files for changing the styling, run the below code in the command line for the project
        // php artisan vendor:publish --tag=laravel-pagination


        // the default paginate method uses the following parameters/arguments
        // public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);



        // below is how you would grab the data using get. A new version using paginate (3 posts per page type thing) is shown above
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // here is a way to order our posts using some methods from the Laravel Query Builder
        // right now, we're ordering our posts by created at time, and going in a descending order (desc)
        // When we order like this, we need to make sure we chain the get at the end - otherwise, it wont actually get any posts

        return view('blog.index', ['posts' => $posts]);
        // With this post model, we can return a view. The view we want to return is our blog.index view
        // We're going to pass some data as well, which is our posts variable, which we assign to dollar sign post
        // In order to do that, we have to create it by using our post model and calling get posts  
    }
    //in this controller, we create methods that are called actions. These are called actions because we will link them up in the routes file and therefore connect our routes to certain methods in this controller, which should get executed



    public function getAdminIndex() {
        // $posts = Post::all();

        $posts = Post::orderBy('title', 'asc')->get();
        return view('admin.index', ['posts' => $posts]);

        // This function does the same as getIndex - it loads all posts to present them, but does it on the admin index view
    }

    public function getPost($id) {
        // Used to contain Store $session when working using data from and storing data in session
        
        
        
        // $post = new Post();
        // $post = $post->getPost($session, $id);
        // old solution from when using session storage - new solution using database is below

        $post = Post::find($id);
        // this is lazy loading - it only loads data if the data is needed. We can use eager loading in the code below by using the with method
        // $post = Post::find($id)-with('likes');

        // We're already passing id into this getPost method, so we're just using that variable and passing it into the find method that is already part of the Laravel Eloquent thingy
        return view('blog.post', ['post' => $post]);

        // This function is used for whenever we try to access a sinle post
        // We use this whenever we try to access a single post, like by clicking on read more
        // It fetches this post from the post model and displays it on the blog post view
    }

    public function getLikePost($id) {
        $post = Post::find($id);
        $like = new Like();
        // here we're creating a new like after getting the post by the passed id
        // we've passed in the like model at the top of the controller so we can use the like model and it's methods
        $post->likes()->save($like);
        // now, we're saving the like that was created
        // we do that by accessing the relation with post->likes, and then we just use the save method on that relation, and pass the like we want to save
        return redirect()->back();


        // this is our new method that allows us to add a like to a post
    }

    public function getAdminCreate() {
        // this used the tag model, which we loaded at the top of the controller
        
        $tags = Tag::all();
        // this fetches all the tags
        return view('admin.create', ['tags' => $tags]);
        // and because fetching is now not enough, we're passing the tags here too

        // All this function does is return the view where the admin creates a new post
    }

    public function getAdminEdit($id) {
        // Used to contain Store $session when working using data from and storing data in session
        
        
        
        
        $post = Post::find($id);
        // We can actually use something different here - apparently find is a convenience method (?)
        
        // $post = Post::where('id', '=', $id)->first();
        // the above is an alternative to find - it's pretty much what happens behind the scenes
        // instead, we really will just use find because it's shorter

        $tags = Tag::all();


        return view('admin.edit', ['post' => $post, 'postId' => $id], ['tags' => $tags]);

        // Here, we fetch a single post, and then load the admin edit view, and send the post data to that view where it is displayed
    }

    public function postAdminCreate(Request $request) {
        // Used to contain Store $session when working using data from and storing data in session
        


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
        
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        // So - the skinny on this - we're inserting data by executing $post->tags(), and using the attach method to actually insert the data
        // The attach method can take a single value (1 tag id) or an array of values (an array of tag ids)
        // The reason passing the $request->input('tags') gives us an array of only checked tags is because we're passing an array in the name of each tag
        // Somehow, when we pass 'tags[]' as the name for our checkbox input, whenever a checkbox is checked, the tag name or id or whatever gets stored in that 'tags[]' array - I don't understand how as this isn't explained
        // So, when we bring in that array here, we're bringing in an array that contains the checked tags
        // We have to be sure the array we're bringing in actually contains something and isn't just empty, so we check to see if it's equal to null (i.e. if there's nothing in the array)
        // If it's equal to null, then we use a blank or empty array - if it's not, then we continue to use the array of tags we were just passing


        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    
        // This is the action used whenever the administrator submits the create post form - the same form that gets loaded in the getAdminCreate route
        // That admin create form has a submit button, so whenever the submit button is clicked on the admin create form, this is the function/action that gets triggered
        // All we're doing here is calling the addPost method on the Post model and pass the title and the content to it
        // Afterwards, the user is redirected to the index page, which shows that the post was created, and displays a message saying your posts new title is whatever the new title name is

    }

    public function postAdminUpdate(Request $request) {
        // Used to contain Store $session when working using data from and storing data in session
        


        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        
        
        
        // $post = new Post();
        // $post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
        // Old solution from when we used session storage/data - new solution using database below


        $post = Post::find($request->input('id'));
        // Here, we're grabbing the specific post we updated in our edit view
        // Because we passed the id already in our update method, we can just access it from the id on the page by using the input method

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        // here' I think because we're feeding it the same ID, laravel takes care of updating that database entry instead of just saving it as a new entry

        // $post->tags()->detach();
        // this, as it sits, removes all the existing tags 
        // $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        // Apparently we don't need to use either of these things, because we can just use the just mentioned laravel sync method below

        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        // this somehow figures out which tags changed, and will only detach the ones that are no longer selected


        return redirect()->route('admin.index')->with('info', 'Post edited, Title is: ' . $request->input('title'));
    
        // postAdminUpdate is pretty much the same as postAdminCreate, except this is for editing the post
        // Here, we're calling the editPost method on our Post model, passing the post ID as well as the new content, and then redirecting the user to the index page where that post edited message is displayed

    }

    public function getAdminDelete($id) {
        $post = Post::find($id);

        // when we delete a post, we also need to delete the connection to the like
        $post->likes()->delete();
        // so, what we'll do is grab the post, access all the likes for it, and delete those likes 

        // We also need to delete the tags associated with the post from the post when the post is deleted
        $post->tags()->detach();
        // this just detachs all tags

        $post->delete();
        // this is a hard delete, meaning the data is deleted forever without a trace - you don't always want to do this
        return redirect()->route('admin.index')->with('info', 'Post Deleted!');
    }


}
