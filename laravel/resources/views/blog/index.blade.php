@extends('layouts.master')
<!-- Tells us what file we want to extend, necessary for if we are using the layout of another page and just filling it in here -->

@section('content')
<!-- You must use this to grab the hook for the page you're extending so you don't break your HTML -->

<div class="row">
    <div class="col-md-12">
        <p class="quote">The beautiful Laravel</p>
    </div>
</div>

<!-- Below, we're creating a dynamic way of passing in our posts data using our controller -->
@foreach($posts as $post)
<div class="row">
    <div class="col-md-12">
        <h1 class="post-title">{{ $post->title }}</h1>
        <!-- this is set up to access the information for each post that we're getting from our database
            We've stored it in our posts variable, so we can access the data as properties instead of as data in an array.
            Old method can be found commented out below -->
        <!-- <h1 class="post-title">{{ $post['title'] }}</h1> -->
        <p style="font-weight: bold;">
            @foreach($post->tags as $tag)
            -{{ $tag->name }}
            @endforeach
            <!-- this loops through and displays/outputs all the tags from this post -->
        </p>
        <p><strong>{{ $post->content }}</strong> <a href="
            {{ route('blog.post', 
            ['id' => $post->id]) }}
        ">Read More</a></p>
        <!-- Old way of determining ID from when we used session storage and array is below  -->
        <!-- ['id' => array_search($post, $posts)] -->
        <!-- adding a second parameter to pass the post id for the blog post route -->
        <!-- the name of the parameter we're passing has to match the name of the variable we gave it in the route path folder thing -->
    </div>
</div>
@endforeach


@endsection
<!-- You have to end the section when you are done with it -->