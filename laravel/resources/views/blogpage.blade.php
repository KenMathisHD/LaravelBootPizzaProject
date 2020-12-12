@extends('layouts.master')
<!-- Tells us what file we want to extend, necessary for if we are using the layout of another page and just filling it in here -->

@section('content')
<!-- You must use this to grab the hook for the page you're extending so you don't break your HTML -->

<div class="row">
    <div class="col-md-12">

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="quote">The beautiful Laravel</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1 class="post-title">Learning Laravel</h1>
        <p>This blog post will get you right on track with Laravel</p>
        <p><a href="#">Read more...</a></p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h1 class="post-title">The Next Steps</h1>
        <p>Understanding the basics is great, but you need to be able to make the next steps.</p>
        <p><a href="#">Read more...</a></p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1 class="post-title">Laravel 5.3</h1>
        <p>Though announced as a "minor release", Laravel 5.3 ships with somer very interesting additions and features.</p>
        <p><a href="#">Read more...</a></p>
    </div>
</div>

@endsection
<!-- You have to end the section when you are done with it -->