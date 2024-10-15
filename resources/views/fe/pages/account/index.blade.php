@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Account - Rentify</title>
    <meta content="Halaman Account Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
@endpush
@push('navbar')
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <div class="container d-block border-bottom" style="max-width: 768px;">
            <ul class="navbar-nav flex-row justify-content-between align-items-center mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fe.beranda') }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
                <li>
                    <h5 class="fs-7 fw-bolder">Account</h5>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fe.order_step') }}" class="nav-link">
                        <span style="font-size:22px;">
                            <iconify-icon icon="solar:shield-warning-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endpush
@section('content')
    <div class="row" style="margin:5rem 0;">
        <div class="col-12">
            <div class="row g-2">
                <div class="col-12">
                    <a href="{{ route('fe.account_information') }}">
                        <div class="card border mb-0 text-dark">
                            <div class="p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <iconify-icon icon="solar:user-rounded-broken" width="20px"
                                            height="20px"></iconify-icon>
                                        <h6 class="text-dark fw-bolder mb-0 ms-2">Account Information</h6>
                                    </div>
                                    <iconify-icon icon="solar:alt-arrow-right-linear" width="20px"
                                        height="20px"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('fe.transaction_history') }}">
                        <div class="card border mb-0 text-dark mt-2">
                            <div class="p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <iconify-icon icon="solar:clipboard-text-broken" width="20px"
                                            height="20px"></iconify-icon>
                                        <h6 class="text-dark fw-bolder mb-0 ms-2">Transaction History</h6>
                                    </div>
                                    <iconify-icon icon="solar:alt-arrow-right-linear" width="20px"
                                        height="20px"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                    @php
                        $role = Session::get('user_session')['role'];
                    @endphp
                    @if ($role == 'admin' || $role == 'admin')
                        <a href="{{ route('be.dashboard') }}">
                            <div class="card border mb-0 text-dark mt-2">
                                <div class="p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <iconify-icon icon="solar:layers-minimalistic-broken" width="20px"
                                                height="20px"></iconify-icon>
                                            <h6 class="text-dark fw-bolder mb-0 ms-2">Dashboard</h6>
                                        </div>
                                        <iconify-icon icon="solar:alt-arrow-right-linear" width="20px"
                                            height="20px"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif

                </div>

                <div class="col-12">
                    <button type="button" onclick="logout()" class="btn btn-outline-primary fw-bolder w-100 py-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"
                                class="me-1">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.2">
                                    <path stroke-linejoin="round" d="M15 12H2m0 0l3.5-3M2 12l3.5 3" />
                                    <path
                                        d="M9.002 7c.012-2.175.109-3.353.877-4.121C10.758 2 12.172 2 15 2h1c2.829 0 4.243 0 5.122.879C22 3.757 22 5.172 22 8v8c0 2.828 0 4.243-.878 5.121c-.769.769-1.947.865-4.122.877M9.002 17c.012 2.175.109 3.353.877 4.121c.641.642 1.568.815 3.121.862" />
                                </g>
                            </svg>
                            LOGOUT
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function logout() {
            window.location.replace("{{ route('auth.actLogout') }}")
        }
    </script>
@endpush
