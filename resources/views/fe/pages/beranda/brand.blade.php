@extends('fe.layouts.app_main')
@push('meta-seo')
    <title>Choose Brand - Rentify</title>
    <meta content="Halaman Choose Brand Rentify" name="description">
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
                    <a class="nav-link" href="{{ route('fe.beranda') }}">
                        <span style="font-size:24px;">
                            <iconify-icon icon="solar:arrow-left-broken" width="1.2em" height="1.2em"></iconify-icon>
                        </span>
                    </a>
                </li>
                <li>
                    <h5 class="fs-7 fw-bolder">Choose Brand</h5>
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
            {{-- <img src="{{ asset('assets/fe/images/banner/banner.jpg') }}" alt="banner" class="w-100 rounded-3"> --}}
            <div class="row g-2">
                @forelse ($getBrandsCategories as $item)
                    <div class="col-6 col-sm-3 text-center">
                        <a
                            href="{{ route('fe.get_product', ['category' => $item->category_slug, 'brand' => $item->brand_slug]) }}">
                            <div class="card border h-100">
                                <div class="card-body d-flex align-items-center rounded-4">
                                    <img src="{{ asset('assets/be/images/brands' . '/' . $item->brand_logo) }}"
                                        alt="logo" class="w-100">
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h3 class="text-center fw-bolder">Brand Not Found!</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
