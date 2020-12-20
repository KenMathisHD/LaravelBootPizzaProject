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
        <h1 class="post-title">{{ $post['title'] }}</h1>
        <p>{{ $post['content'] }}</p>
        <p><a href="{{ route('blog.post', ['id' => array_search($post, $posts)]) }}">Read more...</a></p>
        <!-- adding a second parameter to pass the post id for the blog post route -->
        <!-- the name of the parameter we're passing has to match the name of the variable we gave it in the route path folder thing -->
    </div>
</div>
@endforeach


@endsection
<!-- You have to end the section when you are done with it -->