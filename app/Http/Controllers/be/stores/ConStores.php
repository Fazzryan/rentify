<?php

namespace App\Http\Controllers\be\stores;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConStores extends Controller
{
    public function index()
    {
        $getStores = DB::table('stores')->get();
        return view('be.pages.stores.index', compact('getStores'));
    }

    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function add(Request $request)
    {
        $name    = ucwords(strtolower($request->name));
        $slug    = $request->slug;
        $address = $request->address;
        $is_open = $request->is_open;

        $dataAdd = array(
            'name'    => $name,
            'slug'    => $slug,
            'address' => $address,
            'is_open' => $is_open,
        );

        $validasi = $this->validate($request, [
            'name'    => 'required|min:3|max:30',
            'slug'    => 'required|min:3|max:30',
            'address' => 'required|min:3|max:30',
            'is_open' => 'required|max:1'
        ]);

        if ($validasi) {
            // cek apakah address stores sudah ada
            $checkAddress = DB::table('stores')->where('address', $address)->count();
            if ($checkAddress > 0) {
                return redirect()->back()->with('failed', 'Stores Address Available!');
            } else {
                // jika address stores masih kosong maka insert data
                $queryAdd = DB::table('stores')->insert($dataAdd);
                return redirect()->back()->with('success', 'Stores Added Successfully!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action Edit
    //--------------------------------------------------------------------------
    public function edit(Request $request)
    {
        $store_id = $request->store_id;
        $name     = ucwords(strtolower($request->name));
        $slug     = $request->slug;
        $address  = $request->address;
        $is_open  = $request->is_open;

        $dataUpdate = array(
            'name'    => $name,
            'slug'    => $slug,
            'address' => $address,
            'is_open' => $is_open,
        );

        $validasi = $this->validate($request, [
            'name'    => 'required|min:3|max:30',
            'slug'    => 'required|min:3|max:30',
            'address' => 'required|min:3|max:30',
            'is_open' => 'required|max:1'
        ]);

        if ($validasi) {
            // cek apakah id store terdaftar
            $checkId = DB::table('stores')->where('id', $store_id)->count();
            if ($checkId > 0) {
                // cek perubahan
                $checkChanges = DB::table('stores')
                    ->where('id', $store_id)
                    ->where('name', $name)
                    ->where('slug', $slug)
                    ->where('address', $address)
                    ->where('is_open', $is_open)
                    ->count();
                if ($checkChanges > 0) {
                    return redirect()->back()->with('failed', 'Stores No Change!');
                } else {
                    // cek apakah data tersedia 
                    $checkAvailable = DB::table('stores')->where('id', $store_id)->where('address', $address)->count();
                    if ($checkAvailable > 0) {
                        // $updateData = array(
                        //     'name'    => $name,
                        //     'slug'    => $slug,
                        //     'is_open' => $is_open,
                        // );
                        $queryUpdate = DB::table('stores')->where('id', $store_id)->update($dataUpdate);
                        return redirect()->back()->with('success', 'Stores Updated Successfully!');
                    } else {
                        // cek address apakah tersedia
                        $checkAddress = DB::table('stores')->where('address', $address)->count();
                        if ($checkAddress > 0) {
                            return redirect()->back()->with('failed', 'Stores Address Available!')->withInput();
                        } else {
                            $queryUpdate = DB::table('stores')->where('id', $store_id)->update($dataUpdate);
                            return redirect()->back()->with('success', 'Stores Updated Successfully!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Stores Not Found!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Action Delete
    //--------------------------------------------------------------------------
    public function delete(Request $request)
    {
        $storeId = $request->store_id;

        if ($storeId == null) {
            return redirect()->back()->with('failed', 'Stores cannot be empty!');
        } else {
            // cek apakah id teradaftar atau tidak
            $checkId = DB::table('stores')->where('id', $storeId)->count();
            if ($checkId > 0) {
                // jika terdaftar maka
                // Cek relasi ke transaksi 
                $checkRelationToTransaction = DB::table('transactions')->where('store_id', $storeId)->count();
                if ($checkRelationToTransaction > 0) {
                    return redirect()->back()->with('failed', 'This Store is used by one of the Transaction!');
                } else {
                    $delStore = DB::table('stores')->where('id', $storeId)->delete();
                    return redirect()->back()->with('success', 'Store successfully deleted!');
                }
            } else {
                // jika tidak maka
                return redirect()->back()->with('failed', 'Store Not Found!');
            }
        }
    }
}
