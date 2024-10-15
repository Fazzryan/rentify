@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Transactions Add - Rentify</title>
    <meta content="Halaman Transactions Add Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
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
                                    <li class="breadcrumb-item active" aria-current="page">Add</li>
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
            <form action="{{ route('be.transactions.add_action') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="hidden" id="add-transaction_date" name="transaction_date"
                                        value="{{ date('Y-m-d') }}">
                                    <label for="add-product" class="form-label">Product</label>
                                    <select class="selectpicker form-control" id="add-product_id" name="product_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">
                                        @foreach ($getProducts as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add-store" class="form-label">Store</label>
                                    <select class="selectpicker form-control" id="add-store_id" name="store_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">
                                        @foreach ($getStore as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="add-total_amount" class="form-label">Total Amount</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" id="add-total_amount" name="total_amount" class="form-control">
                                </div>
                                <label for="add-duration" class="form-label">Duration</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Days</span>
                                    <input type="number" id="add-duration" name="duration" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="add-started_at" class="form-label">Started At</label>
                                    <input type="date" id="add-started_at" name="started_at" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="add-ended_at" class="form-label">Ended At</label>
                                    <input type="date" id="add-ended_at" name="ended_at" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="add-name" class="form-label">Name</label>
                                    <input type="text" id="add-name" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="add-phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="add-phone_number" name="phone_number"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="add-address" class="form-label">Address</label>
                                    <input type="text" id="add-address" name="address" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="add-delivery_type" class="form-label">Delivery Type</label>
                                    <select id="add-delivery_type" name="delivery_type" class="form-select">
                                        <option value="pickupstore">Pickup Store</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add-is_paid" class="form-label">Already Paid</label>
                                    <select id="add-is_paid" name="is_paid" class="form-select">
                                        <option value="0">Not Paid</option>
                                        <option value="1">Paid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add-proof" class="form-label">Proof</label>
                                    <input type="file" id="add-proof" name="proof" class="form-control"
                                        accept="image/*">
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

    <script></script>
@endpush
