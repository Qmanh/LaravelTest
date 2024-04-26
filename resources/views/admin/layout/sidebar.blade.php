<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homePage') }}">Home Page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(Auth::guard('admin')->user())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.productList') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.postList') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.productCategoryList') }}">Product Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.postCategoryList') }}">Post Categories</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.userList') }}">Users</a>
                </li>
                @endif
            </ul>
        </div>
        <ul class="navbar-nav ml-auto">
            <li><span class="nav-link">Welcome, {{ Auth::user()->name }}</span></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('account.logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</nav>
