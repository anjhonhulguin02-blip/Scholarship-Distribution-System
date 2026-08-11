<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; Block Scholar (Academic Demonstration)</title>
    <meta name="description" content="Sign in to Block Scholar, an academic demonstration of a blockchain-assisted scholarship distribution system. Test data only.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ url('/login') }}">
    <link href="/img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="/css/mstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <div class="row">
            <h1 style="float: left; font-size: 1.75rem; margin: 0;">Login</h1>
            <div class="input-box button" style="float: right;">
                <input name="btnSubmit" type="button" value="Go Back" onclick="window.location.href = '/'" aria-label="Go back to home page">
            </div>
        </div>
        <br>
        @if ($errors->any())
            <div role="alert" style="color:#c0392b; margin-bottom: 1rem;">
                <ul style="margin:0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/login" method="POST">
            @method('post')
            @csrf
            <div class="input-box">
                <label for="email" class="sr-only">Email address</label>
                <input id="email" type="email" name="email" placeholder="Enter Email" autocomplete="email" value="{{ old('email') }}" required>
            </div>
            <div class="input-box">
                <label for="password" class="sr-only">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
            </div>
            <div class="input-box button">
                <input name="btnLogin" type="Submit" value="Login">
            </div>
            <div class="text">
                <h2 style="font-size: 1rem; font-weight: normal;">Don't have an account? <a href="/register">Sign Up</a></h2>
            </div>
        </form>
    </div>
    @if (session()->pull('errorLogin'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Wrong Email or Password, Please Try Again',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('errorLogin') }}
    @endif
    @if (session()->pull('unauthorized'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You Are Not Authorized To Login, Please Contact Your System Administrator',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('unauthorized') }}
    @endif
    @if (session()->pull('wrongEmail'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Wrong Email, Please Try Again',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('wrongEmail') }}
    @endif
</body>

</html>
