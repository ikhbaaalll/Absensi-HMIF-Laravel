<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Arithmatic 3.0 Himpunan Mahasiswa Informatika">
    <meta name="author" content="Muhammad Ikhbal">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" href="{{ asset('icon/icon_round.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Arithmatic 3.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/login/login.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row main-content text-center">
            <div class="col-md-5 text-center company__info">
                <span class="company__logo m-4">
                    <img src="{{ asset('icon/hmif.png') }}" alt="" class="img img-thumbnail" width="400px"
                        height="400px" style="background-color: #06122e">
                </span>
                <h5 class="company_title">Himpunan Mahasiswa Informatika</h5>
            </div>
            <div class="col-md-7 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <h2>Log In</h2>
                    </div>
                    <div class="row">
                        <form action="{{ route('login') }}" method="POST" class="form-group">
                            @csrf
                            <div class="row">
                                <input type="email" name="email" id="E-mail" class="form__input"
                                    placeholder="E-mail">
                            </div>
                            <div class="row">
                                <!-- <span class="fa fa-lock"></span> -->
                                <input type="password" name="password" id="password" class="form__input"
                                    placeholder="Password">
                            </div>
                            <div class="row justify-content-center">
                                <input type="submit" value="Login" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    {{-- <div class="container-fluid text-center footer">
        Coded with &hearts; by <a href="https://bit.ly/yinkaenoch">Yinka.</a></p>
    </div> --}}
</body>

</html>
