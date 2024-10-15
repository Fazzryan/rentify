@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Booking - Rentify</title>
    <meta content="Halaman Booking Detail Rentify" name="description">
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
                    <h5 class="fs-7 fw-bolder">Booking</h5>
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
                <form action="{{ route('fe.act_booking') }}" method="post">
                    @csrf
                    <input type="hidden" id="add-product_id" name="product_id" value="{{ $getProducts->id }}">
                    <input type="hidden" id="add-total_amount" name="total_amount">

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
                                    {{ number_format($getProducts->price, 0, '.', '.') }}/day
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- details --}}
                    <div class="col-12">
                        <h6 class="fw-bolder text-dark mt-3">Details</h6>
                        <p>Silahkan tuliskan detail booking dengan teliti untuk menghindari kesalahan biaya
                            sewa barang.</p>
                    </div>

                    {{-- Duration --}}
                    <div class="col-12">
                        <h6 class="fw-bolder text-dark">How many days?</h6>
                        <input type="hidden" id="price-product" value="{{ $getProducts->price }}">

                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <button type="button" id="btn-min" class="btn btn-primary" disabled>-</button>
                            <input type="number" id="duration-amount" name="duration"
                                class="form-control rounded-0 text-center" pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;" min="1" readonly>
                            <button type="button" id="btn-plus" class="btn btn-primary">+</button>
                        </div>
                    </div>

                    {{-- Date --}}
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h6 class="fw-bolder text-dark mt-3">Started At</h6>
                                <input type="date" name="start_at" class="form-control">
                            </div>
                            <div class="col-12 col-sm-6">
                                <h6 class="fw-bolder text-dark mt-3">Ended At</h6>
                                <input type="date" name="end_at" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- Delivery --}}
                    <div class="col-12">
                        <h6 class="fw-bolder text-dark mt-3">Delivery</h6>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item border rounded mt-1 mt-sm-0 me-2" role="presentation">
                                <button class="nav-link active rounded-1 d-flex align-items-center" id="pills-store-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-store" type="button" role="tab"
                                    aria-controls="pills-store">
                                    <iconify-icon icon="solar:buildings-3-bold" class="me-1"></iconify-icon>
                                    Pickup Store
                                </button>
                            </li>
                            <li class="nav-item border rounded mt-1 mt-sm-0" role="presentation">
                                <button class="nav-link rounded-1 d-flex align-items-center" id="pills-home-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home">
                                    <iconify-icon icon="solar:home-bold" class="me-1"></iconify-icon>
                                    Your Address
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-store" role="tabpanel"
                                aria-labelledby="pills-store-tab" tabindex="0">
                                <div class="row g-2">
                                    @forelse ($getStores as $store)
                                        <div class="col-12 col-sm-6">
                                            <div class="card border mb-0">
                                                <div class="d-flex align-items-center justify-content-between p-3">
                                                    <div>
                                                        <h6 class="fw-bolder text-dark mb-0">{{ $store->name }}</h6>
                                                        <span class="fs-2">{{ $store->address }}</span>
                                                    </div>
                                                    <input type="radio" id="add-store_id" name="store_id"
                                                        class="form-check-input" value="{{ $store->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 col-sm-6">
                                            <p>Stores Not Found!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                                tabindex="0">
                                <h6 class="fw-bolder text-dark mt-3">Adress</h6>
                                <p>Example: Perumahan Citra Lestari No. 10 Blok F, Jawa Barat, 46244</p>
                                <textarea name="address" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- total --}}
                    <div class="col-12 mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-0">
                                    <div class="text-dark fw-bolder d-inline">Rp.
                                        <span id="price-product-now"></span>/
                                    </div>
                                    <div class="fs-3 d-inline">
                                        <span id="duration-product"></span> day
                                    </div>
                                </h5>
                                <span class="fw-bold fs-2">Sub Total</span>
                            </div>
                            <button type="submit" class="btn btn-primary fw-bolder">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('assets/be/js/rupiah.js') }}"></script>
    <script>
        $("#price-product-now").text(formatRupiah("{{ $getProducts->price }}"));
        $("#add-total_amount").val("{{ $getProducts->price }}");

        $("#duration-amount").val(1);
        $("#duration-product").text(1);

        function checkDuration() {
            const duration = $("#duration-amount").val();
            if (duration < 1 || duration == 1) {
                return $("#btn-min").attr('disabled', 'disabled');
            } else {
                return $("#btn-min").prop('disabled', false);
            }
        }

        function calculatePrice() {
            var jml = $("#duration-amount").val();
            var price = $("#price-product").val();
            var total = price * jml;
            return total;
        }

        $("#btn-plus").on('click', function() {
            var durations = $("#duration-amount").get(0).value++;
            $("#duration-product").text(durations + 1);
            checkDuration();
            $("#price-product-now").text(formatRupiah(calculatePrice()));
            $("#add-total_amount").val(calculatePrice());

        });

        $("#btn-min").on('click', function() {
            var durations = $("#duration-amount").get(0).value--;
            $("#duration-product").text(durations - 1);
            checkDuration();
            $("#price-product-now").text(formatRupiah(calculatePrice()));
            $("#add-total_amount").val(calculatePrice());

        });

        $("[type='radio']").on('click', function(e) {
            var previousValue = $(this).attr('previousValue');
            if (previousValue == 'true') {
                this.checked = false;
                $(this).attr('previousValue', this.checked);
            } else {
                this.checked = true;
                $(this).attr('previousValue', this.checked);
            }
        });
    </script>
@endpush
