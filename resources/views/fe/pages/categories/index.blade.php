@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Category - Rentify</title>
    <meta content="Halaman Category Rentify" name="description">
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
                    <a class="nav-link " href="{{ URL::previous() }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
                <li>
                    <h5 class="fw-bolder text-dark">Categories</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('fe.order_step') }}">
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
            <div class="row mb-3">
                <div class="col-12">
                    <div class="row g-1">
                        @foreach ($categories as $item)
                            <div class="col-4">
                                <a href="{{ route('fe.get_category', ['category' => $item->slug]) }}">
                                    <div class="card border mb-0 text-center">
                                        <div class="p-3">
                                            <img src="{{ asset('assets/be/images/categories' . '/' . $item->logo) }}"
                                                alt="logo" style="width: 48px; padding:.7rem;"
                                                class="bg-light rounded-1">
                                            <div class="mt-2 fs-2">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
