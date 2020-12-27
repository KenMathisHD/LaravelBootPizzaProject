@extends('layouts.admin')

@section('content')

@include('partials.errors')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.editP') }}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post['title'] }}">
                <!-- We're putting the post data in the input fields here (by using the value attribute/property) to dynamically pre-populate it with data from the post we're editing -->
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content" value="{{ $post['content'] }}">
            </div>
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $postId }}">
            <!-- this shorthand uses a helper function offered by Laravel that includes the hidden input field for the csrf token that should be included in the post forms we submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection