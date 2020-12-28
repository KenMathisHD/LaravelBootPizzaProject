@extends('layouts.admin')

@section('content')

@include('partials.errors')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.editP') }}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                <!-- We're putting the post data in the input fields here (by using the value attribute/property) to dynamically pre-populate it with data from the post we're editing -->
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content" value="{{ $post->content }}">
            </div>
            @foreach($tags as $tag)
            <div class="checkbox">
                <label for="">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ $post->tags->contains($tag->id) ? 'checked' : ''}}>
                    <!-- this checks if the checkbox should be checked if the post already has this tag -->
                    <!-- for this, we're checking if the tags collection(post-tags) contains the specific id of the tag that we're at right now in our for each loop. If yes, it will be checked by default ('checked' :). If not, it will not be checked (: '')  -->
                    {{ $tag->name }}
                </label>
            </div>
            @endforeach
            <!-- this foreach loops through all our tags and creates checkboxes for each of them  -->
            <!-- it also checks the tags that need to be checked -->
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $postId }}">
            <!-- this shorthand uses a helper function offered by Laravel that includes the hidden input field for the csrf token that should be included in the post forms we submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection