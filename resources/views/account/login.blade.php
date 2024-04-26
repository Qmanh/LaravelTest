<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6 form-group">
            <form action="{{ route('account.authenticate') }}" method="post">
                @csrf
            <h1 class="text-center">Login</h1>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" >
                </div>
                @error('email')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                </div>
                @error('password')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('homePage') }}" class="btn btn-danger">Back Home</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
