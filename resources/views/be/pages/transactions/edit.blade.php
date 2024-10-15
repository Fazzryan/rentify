@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Transactions Edit - Rentify</title>
    <meta content="Halaman Transactions Edit Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
    <style>
        .edt-img {
            cursor: pointer;
        }

        #fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #fullscreen img {
            max-width: 70%;
            max-height: 70%;
            margin: auto;
            /* display: block; */
        }
    </style>
@endpush
@push('breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pt-3 pb-md-1">
                    <div class="row">
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb">
                                <h4>Transactions</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('be.transactions') }}">Transactions</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('be.transactions') }}" class="btn btn-primary">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2.2"
                                            d="m4 12l6-6m-6 6l6 6m-6-6h10.5m5.5 0h-2.5" />
                                    </svg>
                                    <span class="ms-1">Back To Transaction</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('be.layouts.app_session')
            <form action="{{ route('be.transactions.edit_action') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" id="add-transaction_date" name="transaction_date"
                                    value="{{ $getTransactions->transaction_date }}">
                                <div class="mb-3">
                                    <label for="edt-trx_id" class="form-label">Trx Id</label>
                                    <input type="text" id="edt-trx_id" name="trx_id" class="form-control" readonly
                                        value="{{ $getTransactions->trx_id }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-product" class="form-label">Product</label>
                                    <select class="selectpicker form-control" id="edt-product_id" name="product_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">
                                        @foreach ($getProducts as $item)
                                            <option value="{{ $item->id }}" @selected($getTransactions->product_id == $item->id)>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edt-store" class="form-label">Store</label>
                                    <select class="selectpicker form-control" id="edt-store_id" name="store_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">
                                        @foreach ($getStore as $item)
                                            <option value="{{ $item->id }}" @selected($getTransactions->store_id == $item->id)>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="edt-total_amount" class="form-label">Total Amount</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" id="edt-total_amount" name="total_amount" class="form-control"
                                        value="{{ $getTransactions->total_amount }}">
                                </div>
                                <label for="edt-duration" class="form-label">Duration</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Days</span>
                                    <input type="number" id="edt-duration" name="duration" class="form-control"
                                        value="{{ $getTransactions->duration }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-started_at" class="form-label">Started At</label>
                                    <input type="date" id="edt-started_at" name="started_at" class="form-control"
                                        value="{{ $getTransactions->start_at }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-ended_at" class="form-label">Ended At</label>
                                    <input type="date" id="edt-ended_at" name="ended_at" class="form-control"
                                        value="{{ $getTransactions->end_at }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-transaction_date" class="form-label">Transaction Date</label>
                                    <input type="date" id="edt-transaction_date" name="transaction_date"
                                        class="form-control" value="{{ $getTransactions->transaction_date }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="edt-name" class="form-label">Name</label>
                                    <input type="text" id="edt-name" name="name" class="form-control"
                                        value="{{ $getTransactions->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="edt-phone_number" name="phone_number" class="form-control"
                                        value="{{ $getTransactions->phone_number }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-edtress" class="form-label">Address</label>
                                    <input type="text" id="edt-address" name="address" class="form-control"
                                        value="{{ $getTransactions->address }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-delivery_type" class="form-label">Delivery Type</label>
                                    <select id="edt-delivery_type" name="delivery_type" class="form-select">
                                        @foreach ($getDeliveryType as $item)
                                            <option value="{{ $item['id'] }}" @selected($getTransactions->delivery_type == $item['id'])>
                                                {{ $item['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edt-is_paid" class="form-label">Already Paid</label>
                                    <select id="edt-is_paid" name="is_paid" class="form-select">
                                        @foreach ($getIsPaid as $item)
                                            <option value="{{ $item['id'] }}" @selected($getTransactions->is_paid == $item['id'])>
                                                {{ $item['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edt-proof" class="form-label">Proof</label>
                                    <input type="file" id="edt-proof" name="proof" class="form-control"
                                        accept="image/*" onchange="changeImg()">

                                    <input type="hidden" id="edt-old_proof" name="old_proof" class="form-control"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="edt-img">Old Proof</label>
                                    <img id="edt-img" class="edt-img" onclick="openFullscreen()"
                                        src="{{ asset('assets/be/images/transactions/') . '/' . $getTransactions->proof }}"
                                        width="150" />

                                    <div id="fullscreen" onclick="closeFullscreen()">
                                        <img src="{{ asset('assets/be/images/transactions/') . '/' . $getTransactions->proof }}"
                                            alt="Gambar Fullscreen">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('be.transactions') }}" class="btn btn-dark">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Transaction</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.js') }}"></script>
    <script>
        function changeImg() {
            $("#edt-old_proof").val("changeImg");
        }

        function openFullscreen() {
            var imgSrc = $(event.target).attr("src");
            var fullscreenImg = $("#fullscreen img");
            fullscreenImg.src = imgSrc;
            $("#fullscreen").addClass('d-flex');
        }

        function closeFullscreen() {
            $("#fullscreen").removeClass('d-flex');
        }
    </script>
@endpush
