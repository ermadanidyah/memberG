<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Profile Image Studio">
    <!-- Favicon -->

    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">


</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "DM Sans", sans-serif;

    }

    .container {
        height: 100vh;
        width: 100vw;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #FFFFFF;
        background-image: linear-gradient(#CEEBF8, #FFFFFF);
    }

    .login-bg {
        position: absolute;
        bottom: 0;
        width: 90%;
        /* background-blend-mode: multiply; */
    }

    .card {
        width: 50%;
        margin: 10px;
        background-color: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1;
        text-align: center;
        box-shadow: 0px 4px  rgba(0, 0, 0, 0.1);
    }

    .logo {
        margin: 40px 0;
    }

    span {
        display: block;
    }

    h3 {
        color: #055197;
        font-weight: 700;
        font-size: 24px;
        line-height: 31.25px;
        margin-bottom: 20px;
        padding: 0 40px;
    }

    p {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        margin-bottom: 40px;
    }

    .btn {
        width: 344px;
        height: 52px;
        border-radius: 6px;
        background-color: #00B5D9;
        color: #FFFFFF;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        gap: 27px;
        margin-bottom: 30px;
        border:0;
    }

    .btn:hover {
        background-color: #00BDE2;
    }
    .form-control.login{
        margin-bottom: 1rem;
        padding-block: 0.8rem;
        width: 100%;
    }
</style>

<body>
    <section class="container">
        <div class="card">

            <h3>Selamat Datang </h3>
            <p>Silahkan Login menggunakan akun yang sudah didaftarkan untuk <span> masuk ke dashboard.</span></p>
            <form action="{{ route('login-admin.action') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <input type="text" name="username" class="form-control login @error('username') is-invalid @enderror" id="username" placeholder="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control login @error('password') is-invalid @enderror" id="password" placeholder="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn">Login</button>
                </div>
            </form>
        </div>
        </div>
        <img src="{{asset('assets/login-bg.png')}}" class="login-bg">
    </section>
</body>

</html>
