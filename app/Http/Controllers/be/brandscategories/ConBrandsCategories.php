<?php

namespace App\Http\Controllers\be\brandscategories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConBrandsCategories extends Controller
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
        return view('be.pages.brandscategories.index', compact('getBrandsCategories', 'getCategories', 'getBrands'));
    }

    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function add_brandcategories(Request $request)
    {
        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;

        $dataAdd = array(
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
        );
        $validasi = $this->validate($request, [
            'category_id' => 'required',
            'brand_id'    => 'required'
        ]);

        if ($validasi) {
            // cek apakah relasi sudah ada
            $checkRelation = DB::table('brandscategories')
                ->where('category_id', $category_id)
                ->where('brand_id', $brand_id)->count();
            if ($checkRelation > 0) {
                return redirect()->back()->with('failed', 'Relation Available!');
            } else {
                // jika kategori masih kosong maka insert data
                $queryAdd = DB::table('brandscategories')->insert($dataAdd);
                return redirect()->back()->with('success', 'Relation Added Successfully!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action Edit
    //--------------------------------------------------------------------------
    public function edit_brandcategories(Request $request)
    {
        $id          = $request->brandcategory_id;
        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;

        $dataUpdate = array(
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
        );
        $validasi = $this->validate($request, [
            'category_id' => 'required',
            'brand_id'    => 'required'
        ]);

        if ($validasi) {
            $checkId = DB::table('brandscategories')->where('id', $id)->count();
            if ($checkId > 0) {
                // cek apakah ada perubahan
                $checkChanges = DB::table('brandscategories')
                    ->where('id', $id)
                    ->where('category_id', $category_id)
                    ->where('brand_id', $brand_id)->count();
                if ($checkChanges > 0) {
                    return redirect()->back()->with('failed', 'Relation No Change!');
                } else {
                    // cek apakah relasi sudah ada
                    $checkRelation = DB::table('brandscategories')
                        ->where('category_id', $category_id)
                        ->where('brand_id', $brand_id)->count();
                    if ($checkRelation > 0) {
                        return redirect()->back()->with('failed', 'Relation Available!');
                    } else {
                        // jika kategori masih kosong maka insert data
                        $queryUpdate = DB::table('brandscategories')->where('id', $id)->update($dataUpdate);
                        return redirect()->back()->with('success', 'Relation Updated Successfully!');
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Relation Not Found!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action Delete
    //--------------------------------------------------------------------------
    public function delete_brandcategories(Request $request)
    {
        $id = $request->brandcategory_id;

        if ($id == null) {
            return redirect()->back()->with('failed', 'Relation cannot be empty!');
        } else {
            $checkId = DB::table('brandscategories')->where('id', $id)->count();
            if ($checkId > 0) {
                $queryDelete = DB::table('brandscategories')->where('id', $id)->delete();
                return redirect()->back()->with('success', 'Relation deleted Successfully!');
            } else {
                return redirect()->back()->with('failed', 'Relation Not Found!');
            }
        }
    }
}
