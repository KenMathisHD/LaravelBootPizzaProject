<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{ route('blog-index') }}" class="navbar-brand">Laravel Guide</a>
            <ul class="nav navbar-nav">
                <li><a href="{{ route('blog-index') }}">Blog</a></li>
                <li><a href="{{ route('other.about') }}">About</a></li>
                <li><a href="{{ route('admin.index') }}">Admin</a></li>
                
                <!-- Adding the name for the path/route here in the double curly brackets using the route method -->
            </ul>
        </div>
    </div>
</nav>