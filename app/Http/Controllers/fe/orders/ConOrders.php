<?php

namespace App\Http\Controllers\fe\orders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use function Laravel\Prompts\select;

class ConOrders extends Controller
{
    public function index()
    {
        return view('fe.pages.orders.index');
    }

    public function orders_details(Request $request)
    {
        $phoneNumber = $request->phone_number;
        $trxId       = $request->trx_id;

        $validate = $this->validate($request, [
            'trx_id'       => 'required',
            'phone_number' => 'required',
        ]);

        if ($validate) {
            $getTransactions = DB::table('transactions')
                ->where('trx_id', $trxId)
                ->where('phone_number', $phoneNumber)
                ->first();

            if ($getTransactions) {
                $product =  DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select(
                        'products.name as product_name',
                        'products.price as product_price',
                        'categories.name as category_name'
                    )
                    ->where('products.id', $getTransactions->product_id)
                    ->first();

                $productImg  = DB::table('productsimages')->where('product_id', $getTransactions->product_id)->first();

                $store = DB::table('stores')
                    ->select('name', 'address')
                    ->where('id', $getTransactions->store_id)
                    ->first();

                return view('fe.pages.orders.orders_details', compact('getTransactions', 'productImg', 'product', 'store'));
            } else {
                return redirect()->back()->with('failed', 'Transaction Not Found!');
            }
        }
    }
}
