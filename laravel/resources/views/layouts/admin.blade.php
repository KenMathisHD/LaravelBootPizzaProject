<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Arizonia' rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
    <!-- Using a facade above to pull in the CSS from its spot no matter how that path changes -->

    <title>That are Laravel Views with Laravel Blade</title>


</head>

<body>
    @include('partials.header')
    <!-- this adds the header, a 'partial' we created, to our master layout -->
    <div class="container">
        @yield('content')
    </div>
    <!-- This is called a hook, we provide this for other pages that want to use this layout so they can grab this layout, or 'hook' -->
</body>

</html>