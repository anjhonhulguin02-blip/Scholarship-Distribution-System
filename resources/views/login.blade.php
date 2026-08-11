<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Block Scholar </title>
    <link rel="stylesheet" href="/css/mstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <div class="row">
            <h2 style="float: left;">Login</h2>
            <div class="input-box button" style="float: right;" onclick="window.location.href = '/'">
                <input name="btnSubmit" type="button" value="Go Back">
            </div>
        </div>
        <br>
        <form action="/login" method="POST">
            @method('post')
            @csrf
            <div class="input-box">
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="input-box button">
                <input name="btnLogin" type="Submit" value="Login">
            </div>
            <div class="text">
                <h3>Don't have an account? <a href="/?signup=true">Sign Up</a></h3>
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
