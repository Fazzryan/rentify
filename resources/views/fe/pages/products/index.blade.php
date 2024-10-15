@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Products - Rentify</title>
    <meta content="Halaman Products Rentify" name="description">
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
                    <a class="nav-link" href="{{ URL::previous() }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
                <li>
                    <h5 class="fs-7 fw-bolder">Choose Products</h5>
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
        @if ($brandProductsAmount)
            <div class="col-12 gx-2">
                <div class="card mb-2 border">
                    <div class="d-flex align-items-center justify-content-between p-3 px-md-5">
                        <img src="{{ asset('assets/be/images/brands' . '/' . $getBrands->brand_logo) }}" alt="logo"
                            style="width:60px; aspect-ratio:1/1; object-fit:contain">
                        <div>
                            <h5 class="fw-bolder mb-0">{{ $getBrands->brand_name }}</h5>
                            <span class="fs-2">{{ $brandProductsAmount }} Products</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="row">
                @forelse ($getProducts as $item)
                    <div class="col-6 col-sm-3 gx-2">
                        <a href="{{ route('fe.get_product_detail', ['product' => $item->slug]) }}">
                            <div class="card border">
                                <div class="p-3">
                                    <img src="{{ asset('assets/be/images/products/' . '/' . $item->firstImage->image_name) }}"
                                        alt="{{ $item->name }}" class="rounded-1 w-100"
                                        style="object-fit: cover;aspect-ratio:1/1;">
                                </div>
                                <div class="pb-3 px-3">
                                    <h6 class="fw-bolder mb-1">{{ $item->name }}</h6>
                                    <span class="fw-bold text-dark" style="font-size: 13px;">Rp.
                                        {{ number_format($item->price, 0, '.', '.') }}/day</span>
                                    <div class="d-flex align-items-center justify-content-between fs-2 mt-1">
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
                        </a>
                    </div>
                @empty
                    <h3 class="text-center fw-bolder">Product Not Found!</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
