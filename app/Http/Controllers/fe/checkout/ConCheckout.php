<?php

namespace App\Http\Controllers\fe\checkout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ConCheckout extends Controller
{
    public function index(Request $request)
    {
        $users   = session()->get('user_session');
        $booking = session()->get('booking');

        $userId   = $users['user_id'];
        $username = $users['username'];

        // jika session nya kosong / user mencoba mengakses route /checkout
        if ($booking == null || $users == null) {
            return redirect()->route('fe.beranda');
        }
        // dd($booking);
        $productId = $booking['product_id'];
        $totalAmount = $booking['total_amount'];

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

        return view('fe.pages.checkout.index', compact(
            'getProducts',
            'userId',
            'username',
            'firstImage',
            'totalAmount'
        ));
    }

    public function act_checkout(Request $request)
    {
        $userId          = $request->user_id;
        $name            = ucwords(strtolower($request->name));
        $phoneNumber     = $request->phone_number;
        $transactionDate = $request->transaction_date;
        $proof           = $request->proof;

        $validate = $this->validate($request, [
            'user_id'      => 'required',
            'name'         => 'required|min:3',
            'phone_number' => 'required'
        ]);
        // ambil data session booking
        // session()->forget('booking');
        $booking = session()->get('booking');

        $address = $booking['address'] == null ? '-' : $booking['address'];
        $storeId = $booking['store_id'] == null ? 0 : $booking['store_id'];

        $productId    = $booking['product_id'];
        $totalAmount  = $booking['total_amount'];
        $deliveryType = $booking['delivery_type'];
        $duration     = $booking['duration'];
        $startAt      = $booking['start_at'];
        $endAt        = $booking['end_at'];
        // dd($booking);
        $trxId = 'RNT-' . date('Ymd') . rand(100, 1000);
        $isPaid = 0;

        $dataAdd = array(
            'name'          => $name,
            'user_id'       => $userId,
            'trx_id'        => $trxId,
            'phone_number'  => $phoneNumber,
            'address'       => $address,
            'total_amount'  => $totalAmount,
            'is_paid'       => $isPaid,
            'product_id'    => $productId,
            'store_id'      => $storeId,
            'duration'      => $duration,
            'start_at'      => $startAt,
            'end_at'        => $endAt,
            'delivery_type' => $deliveryType,
            'transaction_date' => $transactionDate,
        );

        if ($proof == null) {
            return redirect()->back()->with('error', 'Proof cannot be empty!');
        } else {
            $proofImg = $request->file('proof');
            if ($validate) {
                $oriExtention = $proofImg->getClientOriginalExtension();
                $oriSize      = number_format($proofImg->getSize() / 1024, 0); //KB
                $imageSize    = str_replace(',', '', $oriSize);

                if (($oriExtention == "jpg") || ($oriExtention == "jpeg") || ($oriExtention == "JPG") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                    if ($imageSize > 2000) {
                        return redirect()->back()->with('failed', 'Maximum image size 2 Mb!')->withInput();
                    } else {
                        //package update
                        $imageName = "proofimg-" . rand() . "." . $oriExtention;
                        $data_update_with_image = array_merge($dataAdd, array('proof' => $imageName));

                        $queryAddGetId = DB::table('transactions')->insertGetId($data_update_with_image);
                        $proofImg->move(public_path('/assets/be/images/transactions/'), $imageName);

                        // hapus session booking
                        session()->forget('booking');

                        // buat session transactionId untuk ditampilkan dihalaman sukses
                        session()->put('transactionId', $queryAddGetId);

                        return redirect()->route('fe.checkout_success')->with('success', 'Transaction Added Successfully!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Photo extension must be .jpg or .png!')->withInput();
                }
            }
        }
    }

    public function checkout_success()
    {
        // Ambil ID transaksi dari flash data
        $transactionId = session()->get('transactionId');
        $transaction = DB::table('transactions')->where('id', $transactionId)->first();

        if ($transaction == null) {
            return redirect()->route('fe.beranda');
        }

        $trxId = $transaction->trx_id;
        $productId = $transaction->product_id;

        $productImg = DB::table('productsimages')->where('product_id', $productId)->first();

        return view('fe.pages.checkout.success', compact('trxId', 'productImg'));
    }
}
