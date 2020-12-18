@extends('layouts.admin')

@section('content')

<!-- below, we're using an if block to determine if the Session has the temporary data titled info. We're using the has method for this -->
<!-- If it doesn't, then we wont show the popup block. Otherwise, we will -->
@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info">{{ Session::get('info') }}</p>
        <!-- This is where we'll output the info from the routes page post edit route -->
        <!-- Here we're using the session facade with the get method to get any data on the session  -->
        <!-- In this case, we're getting the info data we passed. We use info because it's the keyname we assigned in our routes file for the route we're using for this -->

    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.create') }}" class="btn btn-success">New Post</a></div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <p><strong>Learning Laravel</strong> <a href="{{ route('admin.edit', ['id' => 1]) }}">Edit</a></p>
    </div>
</div>

@endsection