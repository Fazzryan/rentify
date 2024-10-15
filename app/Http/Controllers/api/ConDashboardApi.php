<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConDashboardApi extends Controller
{
    public function search_transaction(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $validate = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validate->fails()) {
            $errorMessage = $validate->errors()->first();
            $data = [
                'status'  => 401,
                'message' => $errorMessage,
            ];
            return response()->json($data);
        }

        $transactionAmount = DB::table('transactions')
            ->whereBetween('transaction_date', array($startDate, $endDate))
            ->where('is_paid', 1)
            ->sum('transactions.total_amount');

        $transactionCount = DB::table('transactions')
            ->whereBetween('transaction_date', array($startDate, $endDate))
            ->where('is_paid', 1)
            ->count();

        $topSalesProduct = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join(
                DB::raw('(SELECT product_id, MIN(image_name) as image_name FROM productsimages GROUP BY product_id) as product_img'),
                'products.id',
                '=',
                'product_img.product_id'
            )
            ->select(
                'products.name as product_name',
                'products.price as product_price',
                'product_img.image_name',
                DB::raw('COUNT(transactions.product_id) as total_rent'),
                DB::raw('SUM(transactions.total_amount) as earnings'),
            )
            ->whereBetween('transactions.transaction_date', array($startDate, $endDate))
            ->where('transactions.is_paid', 1)
            ->groupBy('products.name', 'products.price', 'product_img.image_name')
            ->orderBy('total_rent', 'desc')
            ->limit(5)
            ->get();

        $topSalesCategory = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->join(
                DB::raw('(SELECT id, name,logo FROM categories GROUP BY id, name, logo) as categories'),
                'products.category_id',
                '=',
                'categories.id'
            )
            ->select(
                'categories.name',
                'categories.logo',
                DB::raw('COUNT(transactions.product_id) as total_rent'),
            )
            ->whereBetween('transactions.transaction_date', array($startDate, $endDate))
            ->where('transactions.is_paid', 1)
            ->groupBy('categories.name', 'categories.logo')
            ->orderBy('total_rent', 'desc')
            ->get();

        $data = array(
            "status"  => "200",
            "message" => "Transaction data found!",
            "data"    => array(
                'topSalesProduct'   => $topSalesProduct,
                'topSalesCategory'  => $topSalesCategory,
                'transactionCount'  => $transactionCount,
                'transactionAmount' => $transactionAmount,
            )
        );

        return response($data);
    }
}
