@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Account Information - Rentify</title>
    <meta content="Halaman Account Renti Informationfy" name="description">
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
                    <a class="nav-link" href="{{ URL::previous() }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
                <li>
                    <h5 class="fs-7 fw-bolder">Account Information</h5>
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
                    @include('be.layouts.app_session')
                    <div class="card border mb-0">
                        <div class="p-3">
                            <label for="username" class="form-label fw-bolder">Username</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <iconify-icon icon="solar:user-id-outline" width="1.2em" height="1.2em"></iconify-icon>
                                </span>
                                <input type="text" id="username" name="username" class="form-control fw-bold"
                                    value="{{ $getUser->username }}" readonly>
                            </div>
                            <label for="email" class="form-label fw-bolder">Email</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <iconify-icon icon="solar:mailbox-broken" width="1.2em" height="1.2em"></iconify-icon>
                                </span>
                                <input type="email" id="email" name="email" class="form-control fw-bold"
                                    value="{{ $getUser->email }}" readonly>
                            </div>
                            <label for="password" class="form-label fw-bolder">Password</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <iconify-icon icon="solar:lock-password-unlocked-broken" width="1.2em"
                                        height="1.2em"></iconify-icon>
                                </span>
                                <input type="password" id="password" name="password" class="form-control fw-bold"
                                    value="{{ $getUser->pass }}" readonly>
                                <button class="btn btn-light d-flex align-items-center" type="button" id="btn-show-hide"
                                    onclick="showHidePass()">
                                    <iconify-icon icon="solar:eye-broken" width="1.2em" height="1.2em" class="d-block"
                                        id="show-icon"></iconify-icon>
                                    <iconify-icon icon="solar:eye-closed-broken" width="1.2em" height="1.2em"
                                        class="d-none" id="hide-icon"></iconify-icon>
                                </button>
                            </div>
                            <button type="button" class="btn btn-light fw-bold w-100 mt-2" data-bs-toggle="modal"
                                data-bs-target="#editAccount">
                                <span class="d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:pen-new-square-broken" width="1.2em" height="1.2em"
                                        class="me-2"></iconify-icon>
                                    Edit Account
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Account --}}
    <div class="modal fade" tabindex="-1" id="editAccount" tabindex="-1" aria-labelledby="editAccountLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('fe.act_editaccount') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edt-user_id" name="user_id" value="{{ $getUser->id }}">
                        <div class="mb-3">
                            <label for="edt-username" class="form-label">Username</label>
                            <input type="text" class="form-control fw-bold" id="edt-username" name="username"
                                value="{{ $getUser->username }}">
                        </div>
                        <div class="mb-3">
                            <label for="edt-email" class="form-label">Email</label>
                            <input type="email" class="form-control fw-bold" id="edt-email" name="email"
                                value="{{ $getUser->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="edt-password" class="form-label">New Password</label>
                            <input type="password" class="form-control fw-bold" id="edt-password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
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
@endpush
