<?php

namespace App\Http\Controllers\be\transaction;

use App\Http\Controllers\be\ConTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConTransaction extends Controller
{
    public function index()
    {
        $getTransactions = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join('stores', 'transactions.store_id', '=', 'stores.id')
            ->select('transactions.*', 'products.name as product_name', 'stores.name as store_name')
            ->get();
        // dd($getTransaction);
        return view('be.pages.transactions.index', compact('getTransactions'));
    }

    public function add()
    {
        $getProducts = DB::table('products')->get();
        $getStore    = DB::table('stores')->get();

        $tambahan    = new ConTambahan();

        $getDeliveryType = $tambahan->get_delivery_type();
        $getIsPaid       = $tambahan->get_is_paid();

        return view('be.pages.transactions.add', compact('getProducts', 'getStore', 'getDeliveryType', 'getIsPaid'));
    }

    public function edit($id)
    {
        $transId = base64_decode($id);

        $getTransactions = DB::table('transactions')->where('id', $transId)->first();
        // dd($getTransactions->transaction_date);
        $getProducts = DB::table('products')->get();
        $getStore    = DB::table('stores')->get();

        $tambahan    = new ConTambahan();

        $getDeliveryType = $tambahan->get_delivery_type();
        $getIsPaid       = $tambahan->get_is_paid();

        return view('be.pages.transactions.edit', compact('getTransactions', 'getProducts', 'getStore', 'getDeliveryType', 'getIsPaid'));
    }

    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function add_action(Request $request)
    {
        $name        = ucwords(strtolower($request->name));
        $phoneNumber = $request->phone_number;
        $address     = $request->address;

        $totalAmount = $request->total_amount;
        $isPaid      = $request->is_paid;
        $proof       = $request->proof;

        $productId = $request->product_id;
        $storeId   = $request->store_id;

        $duration     = $request->duration;
        $startedAt    = $request->started_at;
        $endedAt      = $request->ended_at;
        $deliveryType = $request->delivery_type;
        $transactionDate = $request->transaction_date;

        $trxId = 'RNT-' . date('Ymd') . rand(10, 1000);

        $dataAdd = array(
            'name'          => $name,
            'trx_id'        => $trxId,
            'phone_number'  => $phoneNumber,
            'address'       => $address,
            'total_amount'  => $totalAmount,
            'is_paid'       => $isPaid,
            'product_id'    => $productId,
            'store_id'      => $storeId,
            'duration'      => $duration,
            'start_at'      => $startedAt,
            'end_at'        => $endedAt,
            'delivery_type' => $deliveryType,
            'transaction_date' => $transactionDate,
        );

        $validasi = $this->validate($request, [
            'name'          => 'required',
            'phone_number'  => 'required',
            'address'       => 'required',
            'total_amount'  => 'required',
            'is_paid'       => 'required',
            'proof'         => 'required',
            'product_id'    => 'required',
            'store_id'      => 'required',
            'duration'      => 'required',
            'started_at'    => 'required',
            'ended_at'      => 'required',
            'delivery_type' => 'required',
            'transaction_date' => 'required',
        ]);

        if ($proof == null) {
            return redirect()->back()->with('failed', 'Proof cannot be empty!');
        } else {
            $proofImg = $request->file('proof');
            if ($validasi) {
                $oriExtention = $proofImg->getClientOriginalExtension();
                $oriSize      = number_format($proofImg->getSize() / 1024, 0); //KB
                $imageSize    = str_replace(',', '', $oriSize);

                if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                    if ($imageSize > 2000) {
                        return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                    } else {
                        //package update
                        $imageName = "proofimg-" . rand() . "." . $oriExtention;
                        $data_update_with_image = array_merge($dataAdd, array('proof' => $imageName));

                        $queryAdd = DB::table('transactions')->insert($data_update_with_image);
                        $proofImg->move(public_path('/assets/be/images/transactions/'), $imageName);

                        return redirect()->route('be.transactions')->with('success', 'Transaction Added Successfully!');
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
        $trxId       = $request->trx_id;
        $name        = ucwords(strtolower($request->name));
        $phoneNumber = $request->phone_number;
        $address     = $request->address;

        $totalAmount = $request->total_amount;
        $isPaid      = $request->is_paid;
        $proof       = $request->proof;

        $productId = $request->product_id;
        $storeId   = $request->store_id;

        $duration     = $request->duration;
        $startedAt    = $request->started_at;
        $endedAt      = $request->ended_at;
        $deliveryTpye = $request->delivery_type;
        $transactionDate = $request->transaction_date;

        $dataUpdate = array(
            'name'          => $name,
            'phone_number'  => $phoneNumber,
            'address'       => $address,
            'total_amount'  => $totalAmount,
            'is_paid'       => $isPaid,
            'product_id'    => $productId,
            'store_id'      => $storeId,
            'duration'      => $duration,
            'start_at'      => $startedAt,
            'end_at'        => $endedAt,
            'delivery_type' => $deliveryTpye,
            'transaction_date' => $transactionDate,
        );

        $validasi = $this->validate($request, [
            'name'          => 'required',
            'phone_number'  => 'required',
            'address'       => 'required',
            'total_amount'  => 'required',
            'is_paid'       => 'required',
            'product_id'    => 'required',
            'store_id'      => 'required',
            'duration'      => 'required',
            'started_at'    => 'required',
            'ended_at'      => 'required',
            'delivery_type' => 'required',
            'transaction_date' => 'required',
        ]);

        if ($proof == null) {
            if ($validasi) {
                // cek transaksi id apakah ada
                $checkTransId = DB::table('transactions')->where('trx_id', $trxId)->count();
                if ($checkTransId > 0) {
                    // cek perubahan
                    $checkChanges = DB::table('transactions')
                        ->where('name', $name)
                        ->where('trx_id', $trxId)
                        ->where('phone_number', $phoneNumber)
                        ->where('address', $address)
                        ->where('total_amount', $totalAmount)
                        ->where('is_paid', $isPaid)
                        ->where('product_id', $productId)
                        ->where('store_id', $storeId)
                        ->where('duration', $duration)
                        ->where('start_at', $startedAt)
                        ->where('end_at', $endedAt)
                        ->where('delivery_type', $deliveryTpye)
                        ->where('transaction_date', $transactionDate)
                        ->count();
                    if ($checkChanges > 0) {
                        return redirect()->route('be.transactions')->with('failed', 'Transaction No Changes!');
                    } else {
                        $queryUpdate = DB::table('transactions')->where('trx_id', $trxId)->update($dataUpdate);
                        return redirect()->route('be.transactions')->with('success', 'Transaction Updated Successfully!');
                    }
                } else {
                    return redirect()->route('be.transactions')->with('failed', 'Transaction Id Not Found!');
                }
            }
        } else {
            $proofImg = $request->file('proof');
            if ($validasi) {
                $oriExtention = $proofImg->getClientOriginalExtension();
                $oriSize      = number_format($proofImg->getSize() / 1024, 0); //KB
                $imageSize    = str_replace(',', '', $oriSize);

                if (($oriExtention == "jpg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                    if ($imageSize > 2000) {
                        return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                    } else {
                        //package update
                        $imageName = "proofimg-" . rand() . "." . $oriExtention;
                        $data_update_with_image = array_merge($dataUpdate, array('proof' => $imageName));

                        //Unlink Logo
                        $getProof = DB::table('transactions')->where('trx_id', $trxId)->first()->proof;
                        if ($getProof > 0) {
                            unlink(public_path('/assets/be/images/transactions/' . $getProof));
                        }
                        $query_update = DB::table('transactions')->where('trx_id', $trxId)->update($data_update_with_image);
                        $proofImg->move(public_path('/assets/be/images/transactions/'), $imageName);

                        return redirect()->route('be.transactions')->with('success', 'Transaction Updated Successfully!');
                    }
                }
            }
        }
    }
    //--------------------------------------------------------------------------
    //  Action delete
    //--------------------------------------------------------------------------
    public function delete_action(Request $request)
    {
        $id = $request->transaction_id;

        if ($id == null) {
            return redirect()->back()->with('failed', 'Transaction cannot be empty!');
        } else {
            // cek apakah id teradaftar atau tidak
            $checkId = DB::table('transactions')->where('id', $id)->count();
            if ($checkId > 0) {
                $getImg = DB::table('transactions')->where('id', $id)->first()->proof;
                if ($getImg > 0) {
                    // Unlink gambar
                    // jika ada maka hapus gambar nya
                    unlink(public_path('/assets/be/images/transactions/' . $getImg));
                }
                $delStore = DB::table('transactions')->where('id', $id)->delete();
                return redirect()->back()->with('success', 'Transaction successfully deleted!');
            } else {
                return redirect()->back()->with('failed', 'Transaction not found!');
            }
        }
    }
}
