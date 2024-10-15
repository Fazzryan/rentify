<?php

namespace App\Http\Controllers\be\products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use function Laravel\Prompts\select;

class ConProducts extends Controller
{
    public function index()
    {
        $getProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name',
            )
            ->get();

        foreach ($getProducts as $valueProduct) {
            // Query kedua untuk mengambil gambar terkait dengan produk
            $productImg = DB::table('productsimages')->where('product_id', $valueProduct->id)->get();
            // Tambahkan gambar pertama ke objek produk sebagai properti baru
            $valueProduct->firstImage = $productImg->first(); // Hanya gambar pertama
            $valueProduct->allImages = $productImg; // Semua gambar untuk detail
        }
        // dd($getProducts);
        return view('be.pages.products.index', compact('getProducts'));
    }

    public function add()
    {
        $getCategories = DB::table('categories')->get();
        $getBrands     = DB::table('brands')->get();
        return view('be.pages.products.add', compact('getCategories', 'getBrands'));
    }

    public function edit($id)
    {
        $product_id    = base64_decode($id);
        $getProducts   = DB::table('products')->where('id', $product_id)->first();
        // Ambil semua gambar terkait produk
        $productImages = DB::table('productsimages')->where('product_id', $product_id)->get();
        $getCategories = DB::table('categories')->get();
        $getBrands     = DB::table('brands')->get();

        if (!$getProducts) {
            return redirect()->route('be.products')->with('failed', 'Product not found!');
        }
        return view('be.pages.products.edit', compact('getProducts', 'productImages', 'getCategories', 'getBrands'));
    }

    public function get_brand(Request $request)
    {
        $category_id = $request->category_id;

        $getBrandsCategories = DB::table('brandscategories')
            ->join('categories', 'brandscategories.category_id', '=', 'categories.id')
            ->join('brands', 'brandscategories.brand_id', '=', 'brands.id')
            ->select(
                'brandscategories.brand_id as brand_id',
                'brands.name as brand_name'
            )
            ->where('category_id', $category_id)
            ->get();

        foreach ($getBrandsCategories as $item) {
            echo "<option value='$item->brand_id'>$item->brand_name</option>";
        }
    }

    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function add_action(Request $request)
    {
        $name        = ucwords(strtolower($request->name));
        $slug        = $request->slug;
        $description = $request->description;
        $price       = $request->price;
        $stock       = $request->stock;

        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;

        $image       = $request->image;
        // dd($description . '-' . $stock);

        $dataAdd = array(
            'name'        => $name,
            'slug'        => $slug,
            'description' => $description,
            'price'       => $price,
            'stock'       => $stock,
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
        );

        $validasi = $this->validate($request, [
            'name'        => 'required|min:3|max:100',
            'slug'        => 'required|min:3|max:100',
            'description' => 'required',
            'price'       => 'required',
            'stock'       => 'required',
            'category_id' => 'required',
            'brand_id'    => 'required',
            'image.*'     => 'image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk masing-masing gambar
        ]);

        if ($image == null) {
            return redirect()->back()->with('failed', 'Product image cannot be empty!')->withInput();
        } else {
            $productImg = $request->file('image');
            if ($validasi) {
                // cek apakah nama produk tersedia 
                $checkName = DB::table('products')->where('name', $name)->count();
                if ($checkName > 0) {
                    return redirect()->back()->with('failed', 'Product Name Available!')->withInput();
                } else {
                    // Menyimpan data produk ke tabel 'products'
                    $queryAddProducts = DB::table('products')->insertGetId($dataAdd);
                    if ($queryAddProducts) {
                        foreach ($image as $img) {
                            $oriExtention = $img->getClientOriginalExtension();
                            $imageName = "productimg-" . rand() . "." . $oriExtention;
                            $img->move(public_path('/assets/be/images/products/'), $imageName);

                            // Menyimpan data gambar ke tabel 'productsimages'
                            DB::table('productsimages')->insert([
                                'image_name' => $imageName,
                                'product_id' => $queryAddProducts
                            ]);
                        }

                        return redirect()->route('be.products')->with('success', 'Product Added Successfully!');
                    } else {
                        return redirect()->back()->with('failed', 'Failed to add product!');
                    }
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action edit
    //--------------------------------------------------------------------------
    public function edit_action(Request $request)
    {
        $product_id  = $request->product_id;
        $name        = ucwords(strtolower($request->name));
        $slug        = $request->slug;
        $description = $request->description;
        $price       = $request->price;
        $stock       = $request->stock;

        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;

        $image       = $request->image;

        $dataUpdate = array(
            'name'        => $name,
            'slug'        => $slug,
            'description' => $description,
            'price'       => $price,
            'stock'       => $stock,
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
        );

        $validasi = $this->validate($request, [
            'name'        => 'required|min:3|max:100',
            'slug'        => 'required|min:3|max:100',
            'description' => 'required',
            'price'       => 'required',
            'stock'       => 'required',
            'category_id' => 'required',
            'brand_id'    => 'required',
            'image.*'     => 'image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk masing-masing gambar
        ]);

        if ($image == null) {
            if ($validasi) {
                // cek id
                $checkId = DB::table('products')->where('id', $product_id)->count();
                if ($checkId > 0) {
                    // cek perubahan
                    $checkChanges = DB::table('products')
                        ->where('id', $product_id)
                        ->where('name', $name)
                        ->where('slug', $slug)
                        ->where('description', $description)
                        ->where('price', $price)
                        ->where('stock', $stock)
                        ->where('category_id', $category_id)
                        ->where('brand_id', $brand_id)
                        ->count();
                    if ($checkChanges > 0) {
                        return redirect()->route('be.products')->with('failed', 'Product No Change!');
                    } else {
                        // cek apakah data tersedia
                        $checkAvailable = DB::table('products')->where('id', $product_id)->where('name', $name)->count();
                        if ($checkAvailable > 0) {
                            $queryUpdate = DB::table('products')->where('id', $product_id)->update($dataUpdate);
                            return redirect()->route('be.products')->with('success', 'Product Updated Successfully!');
                        } else {
                            // cek nama produk apakah tersedia
                            $checkName = DB::table('products')->where('name', $name)->count();
                            if ($checkName > 0) {
                                return redirect()->back()->with('failed', 'Product Available!');
                            } else {
                                $queryUpdate = DB::table('products')->where('id', $product_id)->update($dataUpdate);
                                return redirect()->route('be.products')->with('success', 'Product Updated Successfully!');
                            }
                        }
                    }
                } else {
                    return redirect()->back('be.products')->with('failed', 'Product Not Found!');
                }
            }
        } else {
            if ($validasi) {
                // cek id
                $checkId = DB::table('products')->where('id', $product_id)->count();
                if ($checkId > 0) {
                    // cek apakah data tersedia
                    $checkAvailable = DB::table('products')->where('id', $product_id)->where('name', $name)->count();
                    if ($checkAvailable > 0) {
                        $queryUpdate = DB::table('products')->where('id', $product_id)->update($dataUpdate);
                        if ($request->hasFile('image')) {
                            $productImg = $request->file('image');

                            // Ambil gambar terkait produk
                            $productImages = DB::table('productsimages')->where('product_id', $product_id)->get();

                            // Hapus gambar lama dari direktori dan database jika ada gambar baru
                            foreach ($productImages as $index => $image) {
                                if (isset($request->file('image')[$index])) {
                                    $imagePath = public_path('/assets/be/images/products/') . $image->image_name;
                                    if (file_exists($imagePath)) {
                                        unlink($imagePath);
                                    }
                                    DB::table('productsimages')->where('id', $image->id)->delete();
                                }
                            }
                            // Proses gambar baru
                            $images = $request->file('image');
                            foreach ($images as $img) {
                                $imageName = "productimg-" . rand() . "." . $img->getClientOriginalExtension();
                                $img->move(public_path('/assets/be/images/products/'), $imageName);

                                // Simpan data gambar baru ke tabel 'productsimages'
                                DB::table('productsimages')->insert([
                                    'image_name' => $imageName,
                                    'product_id' => $product_id
                                ]);
                            }
                        }
                        return redirect()->route('be.products')->with('success', 'Product Updated Successfully!');
                    } else {
                        // cek nama produk apakah tersedia
                        $checkName = DB::table('products')->where('name', $name)->count();
                        if ($checkName > 0) {
                            return redirect()->back()->with('failed', 'Product Available!');
                        } else {
                            $queryUpdate = DB::table('products')->where('id', $product_id)->update($dataUpdate);

                            if ($request->hasFile('image')) {
                                $productImg = $request->file('image');

                                // Ambil gambar terkait produk
                                $productImages = DB::table('productsimages')->where('product_id', $product_id)->get();

                                // Hapus gambar lama dari direktori dan database jika ada gambar baru
                                foreach ($productImages as $index => $image) {
                                    if (isset($request->file('image')[$index])) {
                                        $imagePath = public_path('/assets/be/images/products/') . $image->image_name;
                                        if (file_exists($imagePath)) {
                                            unlink($imagePath);
                                        }
                                        DB::table('productsimages')->where('id', $image->id)->delete();
                                    }
                                }
                                // Proses gambar baru
                                $images = $request->file('image');
                                foreach ($images as $img) {
                                    $imageName = "productimg-" . rand() . "." . $img->getClientOriginalExtension();
                                    $img->move(public_path('/assets/be/images/products/'), $imageName);

                                    // Simpan data gambar baru ke tabel 'productsimages'
                                    DB::table('productsimages')->insert([
                                        'image_name' => $imageName,
                                        'product_id' => $product_id
                                    ]);
                                }
                            }
                            return redirect()->route('be.products')->with('success', 'Product Updated Successfully!');
                        }
                    }
                } else {
                    return redirect()->back('be.products')->with('failed', 'Product Not Found!');
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action delete
    //--------------------------------------------------------------------------
    public function delete_action(Request $request)
    {
        $id = $request->product_id;
        // Ambil semua gambar terkait produk dari tabel 'productsimages'
        $productImages = DB::table('productsimages')->where('product_id', $id)->get();

        // Hapus file gambar dari direktori
        foreach ($productImages as $image) {
            $imagePath = public_path('/assets/be/images/products/') . $image->image_name;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus data gambar dari tabel 'productsimages'
        DB::table('productsimages')->where('product_id', $id)->delete();

        // Hapus data produk dari tabel 'products'
        $queryDeleteProduct = DB::table('products')->where('id', $id)->delete();

        if ($queryDeleteProduct) {
            return redirect()->route('be.products')->with('success', 'Product Deleted Successfully!');
        } else {
            return redirect()->back()->with('failed', 'Failed to delete product!');
        }
    }
}
