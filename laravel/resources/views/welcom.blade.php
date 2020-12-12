@extends('layouts.master')
<!-- Tells us what file we want to extend, necessary for if we are using the layout of another page and just filling it in here -->

@section('content')
<!-- You must use this to grab the hook for the page you're extending so you don't break your HTML -->

<div class="row">
    <div class="col-md-12">
        <h1>Some Content</h1>
        <p>{{ 2 == 2 ? "Hello" : "Does not equal" }}</p>
        <!-- We can use the double curly brackets to execute any single line (single expression) php code within the curly brackets here -->
        <p>{{ 2 == 3 ? "Hello" : "Does not equal" }}</p>




        <h1>Control Structures</h1>
        @if(true)
        <p>This only displays if it is true</p>
        @else
        <p>This only displays if it is false</p>
        @endif
        <hr>
        @for($i = 0; $i < 5; $i++) <p>{{ $i + 1 }} Iteration</p>
            @endfor
        <hr>
        <h2>XSS</h2>
        {{ "<script>alert('Hello')</script>" }}
        {!! "<script>alert('Hello')</script>" !!}

    </div>
</div>

@endsection
<!-- You have to end the section when you are done with it -->