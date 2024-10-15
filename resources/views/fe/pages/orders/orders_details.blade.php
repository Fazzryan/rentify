@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Booking Details - Rentify</title>
    <meta content="Halaman Booking Details Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
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
                    <h5 class="fs-7 fw-bolder">Booking Details</h5>
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
        {{-- Booking ID --}}
        <div class="col-12">
            <div class="card border shadow-sm mb-3">
                <div class="p-3">
                    <h6 class="fw-bolder text-dark">Your Booking ID</h6>
                    <div class="d-flex mt-3">
                        <span class="text-dark" style="font-size: 26px;">
                            <iconify-icon icon="solar:crown-outline" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                        <div class="ms-3">
                            <h6 class="fw-bolder text-dark mb-0">{{ $getTransactions->trx_id }}</h6>
                            <span>Protect your booking ID</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        {{-- Is Paid --}}
        <div class="col-12">
            @if ($getTransactions->is_paid == 0)
                <div class="card border shadow-sm bg-warning mb-3">
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <span class="text-dark" style="font-size: 24px;">
                                <iconify-icon icon="solar:calendar-linear" width="1.2em" height="1.2em"></iconify-icon>
                            </span>
                            <div class="ms-3 text-dark">
                                <h6 class="fw-bolder mb-1">Payment Pending</h6>
                                <span>Tim kami sedang memeriksa transaksi ada pada booking berikut</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border shadow-sm bg-dark mb-3">
                    <div class="p-3 text-white">
                        <div class="d-flex align-items-center">
                            <span class="" style="font-size: 24px;">
                                <iconify-icon icon="solar:calendar-linear" width="1.2em" height="1.2em"></iconify-icon>
                            </span>
                            <div class="ms-3 ">
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-bolder mb-1 text-white">Payment Success</h6>
                                    <iconify-icon icon="solar:verified-check-bold" width="1.2em" height="1.2em"
                                        class="text-success ms-1"></iconify-icon>
                                </div>
                                <span>Pembayaran Anda sudah kami terima dan silahkan menunggu instruksi selanjutnya</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <hr>
        </div>

        {{-- Product --}}
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/be/images/products' . '/' . $productImg->image_name) }}" width="130"
                    alt="product">
                <div class="ms-2">

                    <h6 class="fw-bolder text-dark mb-2" style="font-size: 15px;">{{ $product->product_name }}</h6>
                    <span class="d-flex align-items-center" style="font-size: 13px;">
                        <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em" class="me-1"></iconify-icon>
                        {{ $product->category_name }}
                    </span>
                    <span class="fw-bolder mt-1" style="font-size: 13px;">Rp.
                        {{ number_format($product->product_price, 0, '.', '.') }}/day
                    </span>
                </div>
            </div>
            <hr>
        </div>

        {{-- Details Order --}}
        <div class="col-12">
            <div class="row">
                {{-- name --}}
                <div class="col-12 col-sm-6">
                    <h6 class="fw-bolder text-dark">Name</h6>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <iconify-icon icon="solar:user-rounded-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                        <input type="text" id="add-name" name="name" class="form-control fw-bold"
                            value="{{ $getTransactions->name }}" readonly>
                    </div>
                </div>
                {{-- phone --}}
                <div class="col-12 col-sm-6">
                    <h6 class="fw-bolder text-dark">Phone Number</h6>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <iconify-icon icon="solar:phone-calling-linear" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                        <input type="number" id="phone_number" name="phone_number" class="form-control fw-bold"
                            value="{{ $getTransactions->phone_number }}" readonly>
                    </div>
                </div>
                {{-- started at --}}
                <div class="col-12 col-sm-6">
                    <h6 class="fw-bolder text-dark">Started At</h6>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <iconify-icon icon="solar:calendar-linear" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                        <input type="date" name="start_at" class="form-control fw-bold"
                            value="{{ $getTransactions->start_at }}" readonly>
                    </div>
                </div>
                {{-- ended at --}}
                <div class="col-12 col-sm-6">
                    <h6 class="fw-bolder text-dark">Ended At</h6>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <iconify-icon icon="solar:calendar-linear" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                        <input type="date" name="end_at" class="form-control fw-bold"
                            value="{{ $getTransactions->end_at }}" readonly>
                    </div>
                </div>
                {{-- pickup at --}}
                <div class="col-12 col-sm-6">
                    <h6 class="fw-bolder text-dark">Pickup At</h6>
                    <div class="card border mb-0">
                        <div class="d-flex align-items-center justify-content-start p-3">
                            <iconify-icon icon="solar:buildings-3-broken" width="24" height="24"></iconify-icon>
                            <div class="ms-3">
                                <h6 class="fw-bolder text-dark mb-0">{{ $store->name }}</h6>
                                <span class="fs-2">{{ $store->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <hr>
        </div>
        {{-- Payment Detail --}}
        <div class="col-12">
            <h6 class="fw-bolder text-dark">Payment Details</h6>
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold">Sub Total</span>
                <span class="fw-bold text-dark">Rp.{{ number_format($getTransactions->total_amount, 0, '.', '.') }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold">Grand Total</span>
                <span
                    class="fw-bolder text-dark">Rp.{{ number_format($getTransactions->total_amount, 0, '.', '.') }}</span>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
