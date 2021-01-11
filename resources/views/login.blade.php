<!doctype html>
<html lang="en">
<head>
    <title>Login page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-center">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Login</h1>
                            </div>
                        </div>
                        <form action="{{ route('postLogin') }}" method="post" name="login" id="login">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="user[name]"  class="form-control" id="username"  placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input  name="user[email]"  class="form-control" id="email"  placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="user[password]" id="password"  class="form-control"  placeholder="Enter Password">
                            </div>
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="car-display d-none">
        <div class="container">
            <div class="row mt-5">
                <div id="car-list" class=" col-md-10">
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="/logout">Log out</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    @if (session('login'))
        <script>
            $(function() {
                loadCar();
            });
        </script>
    @endif

</body>
</html>
