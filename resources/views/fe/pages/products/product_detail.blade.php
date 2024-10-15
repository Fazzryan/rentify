@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>{{ $getProducts->name }} - Rentify</title>
    <meta content="Halaman Products Detail Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
@endpush
@push('custom-css')
    <style>
        @media only screen and (max-width: 768px) {
            .product-img-caruosel {
                width: 80%;
            }
        }

        @media only screen and (min-width: 788px) {
            .product-img-caruosel {
                width: 50%;
            }
        }
    </style>
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
                    <h5 class="fs-7 fw-bolder">Product Details</h5>
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
            <div class="row">
                <div class="col-12">
                    <div id="carouselExample" class="carousel carousel-dark slide">
                        <div class="carousel-inner text-center">
                            @foreach ($allImages as $index => $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('assets/be/images/products' . '/' . $image->image_name) }}"
                                        alt="image" class="product-img-caruosel">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <h4 class="fw-bolder mb-0">{{ $getProducts->name }}</h4>
            <div class="d-flex align-items-center justify-content-between fs-3 mt-1">
                <span class="d-flex align-items-center">
                    <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em" class="me-1"></iconify-icon>
                    {{ $getProducts->category_name }}
                </span>
                @if ($getProducts->stock > 1)
                    <span class="badge bg-success-subtle text-success fw-bolder fs-2">Ready</span>
                @endif
            </div>

            {{-- About --}}
            <h5 class="fw-bolder text-dark mt-3">About</h5>
            <p>{!! $getProducts->description !!}</p>

            {{-- Benefit --}}
            <h5 class="fw-bolder text-dark mt-3">Benfits</h5>
            <div class="row g-2">
                <div class="col-6 col-sm-3">
                    <div class="card mb-0 border p-2">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:check-circle-bold" class="text-success" width="1.2em"
                                height="1.2em"></iconify-icon>
                            <span class="fw-bolder text-dark ms-1">Original 100%</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card mb-0 border p-2">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:dollar-bold" class="text-success" width="1.2em"
                                height="1.2em"></iconify-icon>
                            <span class="fw-bolder text-dark ms-1">More Points</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card mb-0 border p-2">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:gps-bold" class="text-success" width="1.2em"
                                height="1.2em"></iconify-icon>
                            <span class="fw-bolder text-dark ms-1">Fully GPS</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="card mb-0 border p-2">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="solar:shield-check-bold" class="text-success" width="1.2em"
                                height="1.2em"></iconify-icon>
                            <span class="fw-bolder text-dark ms-1">Insurances</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Price --}}
            <h5 class="fw-bolder text-dark mt-3">Price</h5>
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bolder text-dark fs-4">Rp.
                    {{ number_format($getProducts->price, 0, '.', '.') }}/day</span>
                <a href="{{ route('fe.booking', ['name' => $getProducts->slug]) }}" method="get">
                    <button type="submit" class="btn btn-primary fw-bolder">Rent Now</button>
                </a>
            </div>

            {{-- Testimonials --}}
            <h5 class="fw-bolder text-dark mt-3">Testimonials</h5>
            <div class="row mt-3 pb-lg-3">
                <div class="col-3">
                    <img src="{{ asset('assets/be/images/profile/user-1.jpg') }}" alt="image"
                        style="width:100%; border-radius:999px; aspect-ratio:1/1; object-fit:contain;">
                </div>
                <div class="col-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fw-bolder text-dark fs-4">Dinda Fazryan</span>
                        <div>
                            @for ($i = 0; $i <= 5; $i++)
                                <span class="fw-bolder">
                                    <iconify-icon icon="solar:star-bold" width="1em" height="1em"
                                        class="text-warning"></iconify-icon>
                                </span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-dark">Bagus banget produk nya, dipakenya anti ribet karena beberapa app sudah ready.</p>
                </div>
                <hr class="mt-sm-3">
            </div>
            <div class="row mt-3 pb-lg-3">
                <div class="col-3">
                    <img src="{{ asset('assets/be/images/profile/user-2.jpg') }}" alt="image"
                        style="width:100%; border-radius:999px; aspect-ratio:1/1; object-fit:contain;">
                </div>
                <div class="col-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fw-bolder text-dark fs-4">Mayasari</span>
                        <div>

                            @for ($i = 0; $i <= 5; $i++)
                                <span class="fw-bolder">
                                    <iconify-icon icon="solar:star-bold" width="1em" height="1em"
                                        class="text-warning"></iconify-icon>
                                </span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-dark">Puas banget sama hp nya. Aplikasi sudah terinstal semua tinggal pake.</p>
                </div>
                <hr class="mt-sm-3">
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
