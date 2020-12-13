@extends('layouts.admin')

@section('content')
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection