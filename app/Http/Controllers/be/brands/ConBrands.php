<?php

namespace App\Http\Controllers\be\brands;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConBrands extends Controller
{
    public function index()
    {
        $getBrands = DB::table('brands')->get();
        return view('be.pages.brands.index', compact('getBrands'));
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
            $brandLogo = $request->file('logo');
            if ($validasi) {
                // cek apakah brand tersedia 
                $checkBrandName = DB::table('brands')->where('name', $name)->count();
                if ($checkBrandName > 0) {
                    return redirect()->back()->with('failed', 'Brand Name Available!')->withInput();
                } else {
                    $oriExtention = $brandLogo->getClientOriginalExtension();
                    $oriSize      = number_format($brandLogo->getSize() / 1024, 0); //KB
                    $imageSize    = str_replace(',', '', $oriSize);

                    if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                        if ($imageSize > 2000) {
                            return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                        } else {
                            //package update
                            $imageName = "brandimg-" . rand() . "." . $oriExtention;
                            $data_update_with_image = array_merge($dataAdd, array('logo' => $imageName));

                            $add = DB::table('brands')->insert($data_update_with_image);
                            $brandLogo->move(public_path('/assets/be/images/brands/'), $imageName);

                            return redirect()->route('be.brands')->with('success', 'Brands Added Successfully!');
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
        $brand_id = $request->brand_id;
        $name     = ucwords(strtolower($request->name));
        $slug     = $request->slug;
        $logo     = $request->logo;

        $dataUpdate = array(
            'name' => $name,
            'slug' => $slug,
        );

        $validasi = $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'slug' => 'required|min:3|max:30',
        ]);

        if ($logo == null) {
            if ($validasi) {
                // cek perubahan data
                $checkChanges = DB::table('brands')
                    ->where('id', $brand_id)
                    ->where('name', $name)
                    ->where('slug', $slug)->count();
                if ($checkChanges > 0) {
                    return redirect()->back()->with('failed', 'Brands No Change!');
                } else {
                    // cek apakah data tersedia 
                    $checkAvailable = DB::table('brands')->where('id', $brand_id)->where('name', $name)->count();
                    if ($checkAvailable > 0) {
                        $queryUpdate = DB::table('brands')->where('id', $brand_id)->update($dataUpdate);
                        return redirect()->back()->with('success', 'Brand Updated Successfully!');
                    } else {
                        // cek nama apakah tersedia
                        $checkName = DB::table('brands')->where('name', $name)->count();
                        if ($checkName > 0) {
                            return redirect()->back()->with('failed', 'Brand Name Available!')->withInput();
                        } else {
                            $queryUpdate = DB::table('brands')->where('id', $brand_id)->update($dataUpdate);
                            return redirect()->back()->with('success', 'Brand Updated Successfully!');
                        }
                    }
                }
            }
        } else {
            $brandLogo = $request->file('logo');
            if ($validasi) {
                $oriExtention = $brandLogo->getClientOriginalExtension();
                $oriSize      = number_format($brandLogo->getSize() / 1024, 0); //KB
                $imageSize    = str_replace(',', '', $oriSize);

                if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                    if ($imageSize > 2000) {
                        return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                    } else {
                        //package update
                        $imageName = "brandimg-" . rand() . "." . $oriExtention;
                        $data_update_with_image = array_merge($dataUpdate, array('logo' => $imageName));

                        // cek apakah data tersedia 
                        $checkAvailable = DB::table('brands')->where('id', $brand_id)->where('name', $name)->count();
                        if ($checkAvailable > 0) {

                            $data_update_with_image_2 = array_merge($dataUpdate, array('logo' => $imageName));
                            //Unlink Logo
                            $getLogo = DB::table('brands')->where('id', $brand_id)->first()->logo;
                            if ($getLogo > 0) {
                                unlink(public_path('/assets/be/images/brands/' . $getLogo));
                            }
                            $queryUpdate = DB::table('brands')->where('id', $brand_id)->update($data_update_with_image_2);
                            $brandLogo->move(public_path('/assets/be/images/brands/'), $imageName);
                            return redirect()->back()->with('success', 'Brand Updated Successfully!');
                        } else {
                            // cek nama apakah tersedia
                            $checkName = DB::table('brands')->where('name', $name)->count();
                            if ($checkName > 0) {
                                return redirect()->back()->with('failed', 'Brand Name Available!')->withInput();
                            } else {
                                //Unlink Logo
                                $getLogo = DB::table('brands')->where('id', $brand_id)->first()->logo;
                                if ($getLogo > 0) {
                                    unlink(public_path('/assets/be/images/brands/' . $getLogo));
                                }
                                $queryUpdate = DB::table('brands')->where('id', $brand_id)->update($data_update_with_image);
                                $brandLogo->move(public_path('/assets/be/images/brands/'), $imageName);
                                return redirect()->back()->with('success', 'Brand Updated Successfully!');
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
        $brandId = $request->brand_id;
        if ($brandId == null) {
            return redirect()->back()->with('failed', 'Brand cannot be empty!');
        } else {
            // cek apakah id teradaftar atau tidak
            $checkId = DB::table('brands')->where('id', $brandId)->count();
            if ($checkId > 0) {
                // jika terdaftar maka
                // Cek relasi ke transaksi 
                $checkRelationToProduct = DB::table('products')->where('brand_id', $brandId)->count();
                if ($checkRelationToProduct > 0) {
                    return redirect()->back()->with('failed', 'This brand is used by one of the Product!');
                } else {
                    $getImg = DB::table('brands')->where('id', $brandId)->first()->logo;
                    if ($getImg > 0) {
                        // Unlink gambar
                        // jika ada maka hapus gambar nya
                        unlink(public_path('/assets/be/images/brands/' . $getImg));
                    }
                    $delStore = DB::table('brands')->where('id', $brandId)->delete();
                    return redirect()->back()->with('success', 'Brand successfully deleted!');
                }
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Brand Not Found!');
            }
        }
    }
}
