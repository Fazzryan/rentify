@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Rentify - Orders</title>
    <meta content="Halaman Orders Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
@endpush
@push('navbar')
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <div class="container d-block border-bottom" style="max-width: 768px;">
            <ul class="navbar-nav flex-row align-items-center justify-content-between">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fe.beranda') }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
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
        <div class="col-12 text-center">
            <h1 class="display-3 ">
                <iconify-icon icon="solar:crown-outline" width="1.2em" height="1.2em"></iconify-icon>
            </h1>
            <h1 class="mb-2 fw-bolder">Check Orders</h1>
            <p class="text-dark">Masukan details berikut untuk melihat status pemesanan Anda saat ini.</p>
        </div>
        <div class="col-12 mt-3">
            @include('be.layouts.app_session')
            <div class="card border">
                <div class="p-3">
                    <form action="{{ route('fe.orders_details') }}" method="post">
                        @csrf
                        <label for="phone_number" class="form-label fw-bolder">Phone Number</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <iconify-icon icon="solar:phone-calling-linear" width="1.2em"
                                    height="1.2em"></iconify-icon>
                            </span>
                            <input type="number" id="phone_number" name="phone_number" class="form-control fw-bold"
                                value="{{ old('phone_number') }}" pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;" placeholder="Insert your phone number">
                        </div>
                        <label for="trx_id" class="form-label fw-bolder">Book ID</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <iconify-icon icon="solar:crown-outline" width="1.2em" height="1.2em"></iconify-icon>
                            </span>
                            <input type="text" id="trx_id" name="trx_id" class="form-control fw-bold"
                                placeholder="Insert your booking id">
                        </div>
                        <button type="submit" class="btn btn-primary fw-bolder w-100">Check My Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
