@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Finish Booking - Rentify</title>
    <meta content="Halaman Finish Booking Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
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
            {{-- @include('be.layouts.app_session') --}}
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h5 class="fw-bolder text-dark">Finish Booking</h5>
                        <p class="mb-0">Kami akan segera menghubungi anda untuk proses pemberian barang</p>
                        <img src="{{ asset('assets/be/images/products/' . $productImg->image_name) }}" class="borwder my-2"
                            alt="product" style="width: 46%; aspect-ratio:1/1;object-fit:cover;">
                    </div>
                    <div class="card border shadow-sm">
                        <div class="p-3">
                            <h6 class="fw-bolder text-dark">Your Booking ID</h6>
                            <div class="d-flex mt-3">
                                <span class="text-dark" style="font-size: 26px;">
                                    <iconify-icon icon="solar:crown-outline" width="1.2em" height="1.2em"></iconify-icon>
                                </span>
                                <div class="ms-2">
                                    <h6 class="fw-bolder text-dark mb-0">{{ $trxId }}</h6>
                                    <span>Protect your booking ID</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary fw-bolder w-100" onclick="browse()">Rent More</button>
                    <button type="button" class="btn btn-primary fw-bolder w-100 mt-2" onclick="order()">Booking
                        Details</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function browse() {
            window.location.replace("{{ route('fe.beranda') }}");
        }

        function order() {
            window.location.replace("{{ route('fe.orders') }}");
        }
    </script>
@endpush
