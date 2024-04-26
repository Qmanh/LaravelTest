<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Home Page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showPost') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showProduct') }}">Products</a>
                </li>

                <li class="nav-item dropdown">
                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Setting
                    </button>
                    @if(Auth::check())
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item nav-link" href="{{route('admin.productList')}}">Management</a></li>
                        </ul>
                    @else
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item nav-link" href="{{route('account.login')}}">Login</a></li>
                        </ul>
                    @endif

            </li>

            </ul>

        </div>
    </div>
</nav>

