@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Checkout - Rentify</title>
    <meta content="Halaman Checkout Detail Rentify" name="description">
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
                    <h5 class="fs-7 fw-bolder">Checkout</h5>
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
            @include('be.layouts.app_session')
            <div class="row">
                <form action="{{ route('fe.act_checkout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="add-transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}">
                    <input type="hidden" id="add-user_id" name="user_id" value="{{ $userId }}">

                    <div class="col-12">
                        <h6 class="fw-bolder text-dark mt-3">Product</h6>
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('assets/be/images/products' . '/' . $firstImage->image_name) }}"
                                    alt="product" width="" class="rounded w-100 py-3">
                            </div>
                            <div class="col-8">
                                <h5 class="fw-bolder text-dark mt-3">{{ $getProducts->name }}</h5>
                                <span class="d-flex align-items-center">
                                    <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em"
                                        class="me-1"></iconify-icon>
                                    {{ $getProducts->category_name }}
                                </span>
                                <span class="fw-bolder mt-1" style="font-size: 13px;">Rp.
                                    {{ number_format($getProducts->price, 0, '.', '.') }}/day</span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    {{-- details --}}
                    <div class="col-12">
                        <h6 class="fw-bolder text-dark mt-3">Customer Information</h6>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h6 class="fw-bolder text-dark mt-2 mt-sm-0">Name</h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <iconify-icon icon="solar:user-rounded-broken" width="1.2em"
                                            height="1.2em"></iconify-icon>
                                    </span>
                                    <input type="text" id="add-name" name="name" class="form-control fw-bold"
                                        value="{{ $username }}" placeholder="Insert your name" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h6 class="fw-bolder text-dark">Phone Number</h6>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <iconify-icon icon="solar:phone-calling-linear" width="1.2em"
                                            height="1.2em"></iconify-icon>
                                    </span>
                                    <input type="number" id="phone_number" name="phone_number" class="form-control fw-bold"
                                        value="{{ old('phone_number') }}" pattern="/^-?\d+\.?\d*$/"
                                        onKeyPress="if(this.value.length==15) return false;"
                                        placeholder="Insert your phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- payment --}}
                    <div class="col-12 mt-3">
                        <h6 class="fw-bolder text-dark">Payment Details</h6>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">Sub Total</span>
                            <span class="fw-bold text-dark">Rp.{{ number_format($totalAmount, 0, '.', '.') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">Grand Total</span>
                            <span class="fw-bolder text-dark">Rp.{{ number_format($totalAmount, 0, '.', '.') }}</span>
                        </div>
                    </div>

                    <hr>
                    {{-- send payment --}}
                    <div class="col-12 mt-3">
                        <h6 class="fw-bolder text-dark">Send Payment</h6>
                        <p>Please make payment via bank transfer below.</p>
                        <div class="d-flex align-items-center justify-content-start justify-content-sm-between">
                            <img src="{{ asset('assets/fe/images/bank/bca.jpg') }}" alt="bca" style="width:70px;">
                            <div class="ms-3">
                                <h6 class="fw-bolder text-dark mb-0">Dinda Fazryan</h6>
                                <span>5220304312</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-start justify-content-sm-between">
                            <img src="{{ asset('assets/fe/images/bank/mandiri.jpg') }}" alt="mandiri"
                                style="width:70px;">
                            <div class="ms-3">
                                <h6 class="fw-bolder text-dark mb-0">Dinda Fazryan</h6>
                                <span>1560009861578</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Confirm payment --}}
                    <div class="col-12">
                        <h6 class="fw-bolder text-dark">Confirm Payment</h6>
                        <input type="file" id="proof" name="proof" class="form-control">
                        <button type="submit" class="btn btn-primary fw-bolder w-100 mt-3 ">Confirm
                            Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
