<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rentify</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/be/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/be/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('assets/be/images/logos/logo.svg') }}" alt="">
                                </a>
                                <div class="text-center">
                                    <h2 class="text-dark">Welcome Back</h2>
                                    <p>Glad to see you again <br>Login to your account below</p>
                                </div>
                                @include('be.layouts.app_session')
                                <form action="{{ route('auth.actLogin') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required value="{{ old('email') }}">
                                    </div>
                                    <label for="password" class="form-label mb-3">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <button class="btn btn-light d-flex align-items-center" type="button"
                                            id="btn-show-hide" onclick="showHidePass()">
                                            <iconify-icon icon="solar:eye-broken" width="1.2em" height="1.2em"
                                                class="d-block" id="show-icon"></iconify-icon>
                                            <iconify-icon icon="solar:eye-closed-broken" width="1.2em" height="1.2em"
                                                class="d-none" id="hide-icon"></iconify-icon>
                                        </button>
                                    </div>
                                    {{-- <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                    </div> --}}
                                    <button type="submit"
                                        class="btn btn-primary fw-bolder w-100 py-8 fs-4 my-3 rounded-2">Sign
                                        In</button>
                                    <div class="text-center">
                                        <p class=" fw-bold">Dont have an account?
                                            <a class="text-primary fw-bold" href="{{ route('auth.register') }}">Sign
                                                up for Free</a>
                                        </p>
                                        <a href="{{ route('fe.beranda') }}" class="text-dark fw-bold">Explore Now
                                            Without Sign In.</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/be/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/be/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script>
        function showHidePass() {
            var $password = $("#password");
            var $hideIcon = $("#hide-icon");
            var $showIcon = $("#show-icon");

            var isPassword = $password.attr("type") === "password";

            $password.attr("type", isPassword ? "text" : "password");

            $hideIcon.toggleClass("d-none d-block", !isPassword); // !isPassword -> isPassword == false
            $showIcon.toggleClass("d-none d-block", isPassword); // isPassword -> isPassword == true
        }
    </script>
</body>

</html>
