@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>How To Order - Rentify</title>
    <meta content="Halaman How To Order Rentify" name="description">
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
            <h4 class="fw-bolder text-dark text-center">How To Rent</h4>
        </div>
    </div>
@endsection
@push('js')
@endpush
