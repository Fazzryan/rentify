@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Products Add - Rentify</title>
    <meta content="Halaman Products Add Rentify" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="rentify" name="keywords">
    <meta content="{{ csrf_token() }}" name="csrf-token">
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
                                <h4>Products</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('be.products') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('be.products') }}" class="btn btn-primary">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2.2"
                                            d="m4 12l6-6m-6 6l6 6m-6-6h10.5m5.5 0h-2.5" />
                                    </svg>
                                    <span class="ms-1">Back To Products</span>
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
            <form action="{{ route('be.products.add_action') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="add-name" class="form-label">Name</label>
                                            <input type="text" id="add-name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div class="alert alert-danger mt-2 py-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <label for="add-price" class="form-label">Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">IDR</span>
                                            <input type="text" id="add-price" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}">
                                        </div>
                                        @error('price')
                                            <div class="alert alert-danger mt-2 py-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="add-slug" class="form-label">Slug</label>
                                            <input type="text" id="add-slug" name="slug"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                value="{{ old('slug') }}" readonly>
                                            @error('slug')
                                                <div class="alert alert-danger mt-2 py-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-stock" class="form-label">Stock</label>
                                            <input type="number" id="add-stock" name="stock"
                                                class="form-control @error('stock') is-invalid @enderror"
                                                value="{{ old('stock') }}">
                                            @error('stock')
                                                <div class="alert alert-danger mt-2 py-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="add-description" class="form-label">Description</label>
                                        <textarea id="add-description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger mt-2 py-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="add-image" class="form-label">Image</label>
                                        <input type="file" id="add-image" name="image[]" class="form-control mb-1"
                                            multiple accept="image/*">
                                        <span class="form-text">You can upload 1 or more image!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="add-category_id" class="form-label">Categories</label>
                                    <select class="selectpicker form-control" id="add-category_id" name="category_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">
                                        <option value="">Choose Category</option>
                                        @foreach ($getCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add-brand_id" class="form-label">Brands</label>
                                    <select class="selectpicker form-control" id="add-brand_id" name="brand_id"
                                        data-style="select-with-transition" data-live-search="true" data-size="10">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('be.products') }}" class="btn btn-dark">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/be/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#add-description'))
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        getSlug('#add-name', '#add-slug');
        // Membuat Slug
        function getSlug(input, output) {
            $(input).keyup(function() {
                var nm_input = $(input).val();
                var lower = nm_input.replace(/\s+/g, '-').toLowerCase();;
                $(output).val(lower);
            });
        }
    </script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        // ambil data brand ketika memilih data category
        $('body').on("change", "#add-category_id", function() {
            var id = $('#add-category_id').val();
            var url = "{{ route('be.products.get_brand') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    category_id: id,
                    _: new Date().getTime() // Menambahkan timestamp untuk menghindari cache
                },
                cache: false,

                success: function(msg) {
                    $("#add-brand_id").empty().html(msg);
                    $("#add-brand_id").selectpicker('destroy'); // Hapus inisialisasi
                    $("#add-brand_id").selectpicker(); // Inisialisasi ulang
                },
                error: function(data) {
                    console.log('error', data);
                }
            });
        });
    </script>
@endpush
