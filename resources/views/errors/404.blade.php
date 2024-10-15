<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/be/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/be/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/mystyles.css') }}" />
    <title>404 Not Found - Rentify</title>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-4 text-center">
                            <img src="{{ asset('assets/be/images/error/404.png') }}" alt="Error" class="w-75">
                            <h6 class="display-3 mt-3 fw-bold">Ooops!</h6>
                            <h3 class="fw-bolder text-dark">Page Not Found</h3>
                            <p>This page doesn't exist or was removed! We suggest you back to home</p>
                            <button type="button" class="btn btn-primary fw-bolder" onclick="home()">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24" class="me-2">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-width="2.2"
                                            d="m10 7.403l-7.007 3.125c-1.324.59-1.324 2.354 0 2.944l16.51 7.363c1.495.667 3.047-.814 2.306-2.202l-3.152-5.904c-.245-.459-.245-1 0-1.458l3.152-5.904c.74-1.388-.81-2.87-2.306-2.202L14.75 5.284" />
                                    </svg>
                                    Back To Home
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script>
        function home() {
            window.location.replace("{{ route('fe.beranda') }}");
        }
    </script>
</body>

</html>
