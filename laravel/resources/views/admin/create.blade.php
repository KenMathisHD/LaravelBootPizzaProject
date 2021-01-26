@extends('layouts.admin')

@section('content')

@include('partials.errors')
<div class="row">
    <div class="col-md-12">
        <!-- hooking up post route in the action part of form below, uses double curly braces -->
        <form action="{{ route('admin.createP') }}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content">
            </div>
            @foreach($tags as $tag)
            <div class="checkbox">
                <label for="">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
            @endforeach
            <!-- this foreach loops through all our tags and creates checkboxes for each of them  -->
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection