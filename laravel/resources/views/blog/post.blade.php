@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <p class="quote">{{ $post->title }}</p>
        <!-- because we passed the post variable to our view (blog.post, that's for this file), we can plug it in here using double curly braces, and giving it the array spot/location/area/block/thing we defined in our routes file -->
        <!-- the variable has to be called dollar sign post because that's how we assigned it in our routes file -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p>{{ count($post->likes) }} Likes |
            <!-- this count post likes thing gives us specifically the number of likes -->
            <a href="{{ route('blog.post.like', ['id' => $post->id]) }}">Like</a>
            <!-- We've also set up a button that links to our likes route that will allow us or a user to like the post, and passes the id of the post being liked -->
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p>{{ $post->content }}</p>
    </div>
</div>
@endsection