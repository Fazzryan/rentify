<?php

namespace App\Http\Controllers\be\categories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use function Laravel\Prompts\select;

class ConCategories extends Controller
{
    public function index()
    {
        $getBrandsCategories = DB::table('brandscategories')
            ->join('categories', 'brandscategories.category_id', '=', 'categories.id')
            ->join('brands', 'brandscategories.brand_id', '=', 'brands.id')
            ->select(
                'brandscategories.id',
                'brandscategories.category_id',
                'brandscategories.brand_id',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->get();

        $getCategories = DB::table('categories')->get();
        $getBrands = DB::table('brands')->get();
        return view('be.pages.categories.index', compact('getBrandsCategories', 'getCategories', 'getBrands'));
    }

    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function add(Request $request)
    {
        $name = ucwords(strtolower($request->name));
        $slug = $request->slug;
        $logo = $request->logo;

        $dataAdd = array(
            'name' => $name,
            'slug' => $slug,
        );
        $validasi = $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'slug' => 'required|min:3|max:30',
            'logo' => 'required',
        ]);
        if ($logo == null) {
            return redirect()->back()->with('failed', 'Brand Logo cannot be empty!');
        } else {
            $categoryLogo = $request->file('logo');
            if ($validasi) {
                // cek apakah kategori sudah ada
                $checkName = DB::table('categories')->where('name', $name)->count();
                if ($checkName > 0) {
                    return redirect()->back()->with('failed', 'Category Available!');
                } else {
                    $oriExtention = $categoryLogo->getClientOriginalExtension();
                    $oriSize      = number_format($categoryLogo->getSize() / 1024, 0); //KB
                    $imageSize    = str_replace(',', '', $oriSize);
                    if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                        if ($imageSize > 2000) {
                            return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                        } else {
                            //package update
                            $imageName = "categoryimg-" . rand() . "." . $oriExtention;
                            $data_update_with_image = array_merge($dataAdd, array('logo' => $imageName));

                            $queryAdd = DB::table('categories')->insert($data_update_with_image);
                            $categoryLogo->move(public_path('/assets/be/images/categories/'), $imageName);
                            // jika kategori masih kosong maka insert data
                            return redirect()->back()->with('success', 'Category Added Successfully!');
                        }
                    }
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action Edit
    //--------------------------------------------------------------------------
    public function edit(Request $request)
    {
        $categoryId = $request->category_id;
        $name        = ucwords(strtolower($request->name));
        $slug        = $request->slug;
        $logo        = $request->logo;

        $dataUpdate = array(
            'name' => $name,
            'slug' => $slug,
        );

        $validasi = $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'slug' => 'required|min:3|max:30'
        ]);
        if ($logo == null) {
            if ($validasi) {
                // cek apakah id kategori terdaftar
                $checkId = DB::table('categories')->where('id', $categoryId)->count();
                if ($checkId > 0) {
                    // cek perubahan
                    $checkChanges = DB::table('categories')
                        ->where('id', $categoryId)
                        ->where('name', $name)->count();
                    if ($checkChanges > 0) {
                        return redirect()->back()->with('failed', 'Category No Change!');
                    } else {
                        // cek apakah kategori sudah ada
                        $checkName = DB::table('categories')->where('name', $name)->count();
                        if ($checkName > 0) {
                            return redirect()->back()->with('failed', 'Category Available!');
                        } else {
                            // jika kategori masih kosong maka insert data
                            $queryAdd = DB::table('categories')->where('id', $categoryId)->update($dataUpdate);
                            return redirect()->back()->with('success', 'Category Updated Successfully!');
                        }
                    }
                } else {
                    return redirect()->back()->with('failed', 'Category Not Found!');
                }
            }
        } else {
            $categoryLogo = $request->file('logo');
            if ($validasi) {
                $oriExtention = $categoryLogo->getClientOriginalExtension();
                $oriSize      = number_format($categoryLogo->getSize() / 1024, 0); //KB
                $imageSize    = str_replace(',', '', $oriSize);
                if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                    if ($imageSize > 2000) {
                        return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                    } else {
                        //package update
                        $imageName = "categoryimg-" . rand() . "." . $oriExtention;
                        $data_update_with_image = array_merge($dataUpdate, array('logo' => $imageName));
                        // cek apakah data tersedia 
                        $checkAvailable = DB::table('categories')->where('id', $categoryId)->where('name', $name)->count();
                        if ($checkAvailable > 0) {
                            $data_update_with_image_2 = array_merge($dataUpdate, array('logo' => $imageName));
                            //Unlink Logo
                            $getLogo = DB::table('categories')->where('id', $categoryId)->first()->logo;
                            if ($getLogo > 0) {
                                unlink(public_path('/assets/be/images/categories/' . $getLogo));
                            }
                            $queryUpdate = DB::table('categories')->where('id', $categoryId)->update($data_update_with_image_2);
                            $categoryLogo->move(public_path('/assets/be/images/categories/'), $imageName);

                            return redirect()->back()->with('success', 'Category Updated Successfully!');
                        } else {
                            // cek nama apakah tersedia
                            $checkName = DB::table('categories')->where('name', $name)->count();
                            if ($checkName > 0) {
                                return redirect()->back()->with('failed', 'categories Name Available!')->withInput();
                            } else {
                                //Unlink Logo
                                $getLogo = DB::table('categories')->where('id', $categoryId)->first()->logo;
                                if ($getLogo > 0) {
                                    unlink(public_path('/assets/be/images/categories/' . $getLogo));
                                }
                                $queryUpdate = DB::table('categories')->where('id', $categoryId)->update($data_update_with_image);
                                $categoryLogo->move(public_path('/assets/be/images/categories/'), $imageName);

                                return redirect()->back()->with('success', 'Categories Updated Successfully!');
                            }
                        }
                    }
                }
            }
        }
    }


    //--------------------------------------------------------------------------
    //  Action Delete
    //--------------------------------------------------------------------------
    public function delete(Request $request)
    {
        $categoryId = $request->category_id;

        if ($categoryId == null) {
            return redirect()->back()->with('failed', 'Category cannot be empty!');
        } else {
            // cek apakah id teradaftar atau tidak
            $checkId = DB::table('categories')->where('id', $categoryId)->count();
            if ($checkId > 0) {
                // jika terdaftar maka
                // Cek relasi ke produk dan bran kategori
                $checkRelationToProducts = DB::table('products')->where('category_id', $categoryId)->count();
                $checkRelationToBrandCategory = DB::table('brandscategories')->where('category_id', $categoryId)->count();

                if (($checkRelationToProducts > 0) || ($checkRelationToBrandCategory > 0)) {
                    return redirect()->back()->with('failed', 'This category is used by one of the Products or Brands!');
                } else {
                    $getImg = DB::table('categories')->where('id', $categoryId)->first()->logo;
                    if ($getImg > 0) {
                        // Unlink gambar
                        // jika ada maka hapus gambar nya
                        unlink(public_path('/assets/be/images/categories/' . $getImg));
                    }
                    $delCategory = DB::table('categories')->where('id', $categoryId)->delete();
                    return redirect()->back()->with('success', 'Category successfully deleted!');
                }
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Category Not Found!');
            }
        }
    }
}
