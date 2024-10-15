<?php

namespace App\Http\Controllers\fe\booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use GuzzleHttp\RedirectMiddleware;

class ConBooking extends Controller
{
    public function booking(Request $request)
    {
        // $booking = session()->get('booking');
        // jika session nya kosong / user mencoba mengakses route /checkout
        // if ($booking == null) {
        //     return redirect()->route('fe.beranda');
        // }

        $productName = $request->name;
        $productId = DB::table('products')->where('slug', $productName)->first()->id;

        $getProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'categories.name as category_name',
            )
            ->where('products.id', $productId)
            ->first();
        $getImagProduct = DB::table('productsimages')
            ->where('product_id', $productId)->get();
        $firstImage = $getImagProduct->first();

        $getStores = DB::table('stores')->where('is_open', 1)->get();
        return view('fe.pages.booking.index', compact('getProducts', 'firstImage', 'getStores'));
    }


    public function act_booking(Request $request)
    {
        $productId   = $request->product_id;
        $storeId     = $request->store_id;
        $address     = $request->address;
        $totalAmount = $request->total_amount;
        $duration    = $request->duration;
        $startAt     = $request->start_at;
        $endAt       = $request->end_at;

        if (!empty($address) || empty($storeId)) {
            $deliveryType = 'address';
        } else if (!empty($storeId) || empty($address)) {
            $deliveryType = 'pickup store';
        }

        $validasi = $this->validate($request, [
            'address'      => 'required',
            'product_id'   => 'required',
            'store_id'     => 'required',
            'total_amount' => 'required',
            'duration'     => 'required',
            'start_at'     => 'required',
            'end_at'       => 'required'
        ]);

        $booking_session = array(
            'address'       => $address,
            'product_id'    => $productId,
            'store_id'      => $storeId,
            'total_amount'  => $totalAmount,
            'delivery_type' => $deliveryType,
            'duration'      => $duration,
            'start_at'      => $startAt,
            'end_at'        => $endAt
        );
        if ($validasi) {
            session()->put('booking', $booking_session);
            return redirect()->route('fe.checkout');
        }
    }
}
