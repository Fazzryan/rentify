<?php

namespace App\Http\Controllers\fe\beranda;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConBeranda extends Controller
{
    public function index()
    {
        $getNewProduct = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name',
            )
            ->where('products.stock', '>', 0)
            ->take(6)
            ->latest()
            ->get();

        foreach ($getNewProduct as $valueProduct) {
            // Query kedua untuk mengambil gambar terkait dengan produk
            $productImg = DB::table('productsimages')->where('product_id', $valueProduct->id)->get();
            // Tambahkan gambar pertama ke objek produk sebagai properti baru
            $valueProduct->firstImage = $productImg->first(); // Hanya gambar pertama
            $valueProduct->allImages = $productImg; // Semua gambar untuk detail
        }

        $getProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name',
            )
            ->where('products.stock', '>', 0)
            ->paginate(14);

        foreach ($getProducts as $valueProduct) {
            // Query kedua untuk mengambil gambar terkait dengan produk
            $productImg = DB::table('productsimages')->where('product_id', $valueProduct->id)->get();
            // Tambahkan gambar pertama ke objek produk sebagai properti baru
            $valueProduct->firstImage = $productImg->first(); // Hanya gambar pertama
            $valueProduct->allImages = $productImg; // Semua gambar untuk detail
        }

        $getCategories = DB::table('categories')->take(6)->get();

        return view('fe.pages.beranda.index', compact(
            'getNewProduct',
            'getProducts',
            'getCategories'
        ));
    }
    public function show_category()
    {
        $categories = DB::table('categories')->get();
        return view('fe.pages.categories.index', compact('categories'));
    }
    public function get_category(Request $request)
    {
        $category_name = $request->category;

        $getCategoryId = DB::table('categories')
            ->select('id as category_id')
            ->where('name', $category_name)
            ->first()->category_id;

        $getBrandsCategories = DB::table('brandscategories')
            ->join('categories', 'brandscategories.category_id', '=', 'categories.id')
            ->join('brands', 'brandscategories.brand_id', '=', 'brands.id')
            ->select(
                'brandscategories.brand_id as brand_id',
                'brands.id as brand_id',
                'brands.name as brand_name',
                'categories.slug as category_slug',
                'brands.slug as brand_slug',
                'brands.logo as brand_logo',
            )
            ->where('category_id', $getCategoryId)
            ->get();

        return view('fe.pages.beranda.brand', compact('getBrandsCategories'));
    }

    public function get_product(Request $request)
    {
        $category = $request->category;
        $brand    = $request->brand;

        $category_id = DB::table('categories')->where('name', $category)->first()->id;
        $brand_id    = DB::table('brands')->where('name', $brand)->first()->id;

        if (!$category_id || !$brand_id) {
            // Redirect dengan pesan error jika ID tidak valid
            return redirect()->back()->with('failde', 'Category Or Brand Not Valid.');
        }
        $getBrands = DB::table('brands')
            ->join('products', 'brands.id', '=', 'products.brand_id')
            ->select(
                'brands.name as brand_name',
                'brands.logo as brand_logo',
                DB::raw('COALESCE(COUNT(products.id), 0) as product_amount')
            )
            ->groupBy('brands.id', 'brands.name', 'brands.slug', 'brands.logo')
            ->where('brands.id', $brand_id)
            ->first();

        $brandProductsAmount = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('brands.id', $brand_id)
            ->where('categories.id', $category_id)
            ->count();

        $getProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name',
            )
            ->where('category_id', $category_id)
            ->where('brand_id', $brand_id)
            ->get();

        foreach ($getProducts as $valueProduct) {
            // Query kedua untuk mengambil gambar terkait dengan produk
            $productImg = DB::table('productsimages')->where('product_id', $valueProduct->id)->get();
            // Tambahkan gambar pertama ke objek produk sebagai properti baru
            $valueProduct->firstImage = $productImg->first(); // Hanya gambar pertama
        }
        return view('fe.pages.products.index', compact('getProducts', 'getBrands', 'brandProductsAmount'));
    }

    public function get_product_detail(Request $request)
    {
        $product_slug = $request->product;
        $getProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name',
            )
            ->where('products.slug', $product_slug)
            ->first();

        $productImg = DB::table('productsimages')->where('product_id', $getProducts->id)->get();

        $firstImage = $productImg->first();
        $allImages = $productImg;

        return view('fe.pages.products.product_detail', compact('getProducts', 'firstImage', 'allImages'));
    }

    public function contact()
    {
        return view('fe.pages.beranda.contact');
    }

    public function order_step()
    {
        return view('fe.pages.beranda.cara_order');
    }
}
