@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Rentify</title>
    <meta content="Halaman Beranda Rentify" name="description">
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
                    <a class="nav-link " href="{{ route('fe.beranda') }}">
                        {{-- <img src="{{ asset('assets/be/images/logos/logo.svg') }}" alt="logo" /> --}}
                        <h3 class="fw-bolder text-primary">Rentify</h3>
                    </a>
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
                    {{-- <img src="{{ asset('assets/fe/images/banner/banner.jpg') }}" alt="banner" class="w-100 rounded-3"> --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="my-3 fw-semibold">Categories</h5>
                        <a href="{{ route('fe.show_category') }}">
                            <div class="d-flex align-items-center">
                                See All
                                <iconify-icon icon="solar:arrow-right-linear" width="1.2em" height="1.2em"
                                    class="ms-1"></iconify-icon>
                            </div>
                        </a>
                    </div>
                    <div class="row g-2">
                        @foreach ($getCategories as $item)
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

            {{-- New Product --}}
            <div class="row g-2 mb-2">
                <h5 class="my-3 fw-semibold">Brand New</h5>
                @foreach ($getNewProduct as $item)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('fe.get_product_detail', ['product' => $item->slug]) }}">
                            <div class="card border mb-0 shadow-sm">
                                <div class="p-3">
                                    <img src="{{ asset('assets/be/images/products/' . '/' . $item->firstImage->image_name) }}"
                                        alt="{{ $item->name }}" class="rounded-1 w-100"
                                        style="object-fit: cover;aspect-ratio:1/1;">
                                </div>
                                <div class="pb-3 px-3">
                                    <h6 class="fw-bolder">{{ Str::limit($item->name, 30, '...') }}</h6>
                                    <span class="fw-bold text-dark" style="font-size: 13px;">Rp.
                                        {{ number_format($item->price, 0, '.', '.') }}/day</span>
                                    <div class="d-flex align-items-center justify-content-between fs-2 mt-2">
                                        <span class="d-flex align-items-center">
                                            <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em"
                                                class="me-1"></iconify-icon>
                                            {{ $item->category_name }}
                                        </span>
                                        @if ($item->stock > 0)
                                            <span class="badge bg-success-subtle text-success fw-bolder fs-1">Ready</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- All Product --}}
            <div class="row g-2 mb-2">
                <h4 class="my-3 fw-semibold">You Might Like</h4>
                @foreach ($getProducts as $item)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('fe.get_product_detail', ['product' => $item->slug]) }}">
                            <div class="card border mb-0 shadow-sm">
                                <div class="p-3">
                                    <img src="{{ asset('assets/be/images/products/' . '/' . $item->firstImage->image_name) }}"
                                        alt="{{ $item->name }}" class="rounded-1 w-100"
                                        style="object-fit: cover;aspect-ratio:1/1;">
                                </div>
                                <div class="pb-3 px-3">
                                    <h6 class="fw-bolder">{{ $item->name }}</h6>
                                    <span class="fw-bold text-dark" style="font-size: 13px;">Rp.
                                        {{ number_format($item->price, 0, '.', '.') }}/day</span>
                                    <div class="d-flex align-items-center justify-content-between fs-2 mt-2">
                                        <span class="d-flex align-items-center">
                                            <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em"
                                                class="me-1"></iconify-icon>
                                            {{ $item->category_name }}
                                        </span>
                                        @if ($item->stock > 0)
                                            <span class="badge bg-success-subtle text-success fw-bolder fs-1">Ready</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-12 col-sm-6">
                        <div class="card border mb-0 shadow-sm">
                            <div class="d-flex w-100">
                                <div class="p-3">
                                    <img src="{{ asset('assets/be/images/products/' . '/' . $item->firstImage->image_name) }}"
                                        alt="{{ $item->name }}" class="rounded-1"
                                        style="width:100px;object-fit: cover;aspect-ratio:1/1;">
                                </div>
                                <div class="mt-3">
                                    <h6 class="fw-bolder">{{ $item->name }}</h6>
                                    <span class="fw-bold text-dark" style="font-size: 13px;">Rp.
                                        {{ number_format($item->price, 0, '.', '.') }}/day</span>
                                    <div class="d-flex align-items-center justify-content-between fs-2 mt-2">
                                        <span class="d-flex align-items-center">
                                            <iconify-icon icon="solar:tag-linear" width="1.2em" height="1.2em"
                                                class="me-1"></iconify-icon>
                                            {{ $item->category_name }}
                                        </span>
                                        @if ($item->stock > 1)
                                            <span class="badge bg-success-subtle text-success fw-bolder fs-1">Ready</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
                <div class="d-flex justify-content-center mt-4">
                    {{ $getProducts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
