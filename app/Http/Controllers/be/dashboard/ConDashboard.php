<?php

namespace App\Http\Controllers\be\dashboard;

use App\Http\Controllers\be\ConTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use function Laravel\Prompts\select;

class ConDashboard extends Controller
{
    public function index()
    {
        // default tanggal mulai dan tanggal akhir
        $dateNowCount = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $startDate = date('Y-m-') . '01';
        $endDate   = date('Y-m-') . $dateNowCount;

        $userAmount        = DB::table('users')->count();
        $brandAmount       = DB::table('brands')->count();
        $storeAmount       = DB::table('stores')->count();
        $productAmount     = DB::table('products')->count();
        $categoryAmount    = DB::table('categories')->count();
        $transactionAmount = DB::table('transactions')
            ->whereBetween('transaction_date', array($startDate, $endDate))
            ->count();

        // cek ada berapa jumlah transaksi yang status nya sudah lunas. hitung total amount nya
        $totalIncome = DB::table('transactions')
            ->whereBetween('transaction_date', array($startDate, $endDate))
            ->where('is_paid', 1)
            ->sum('total_amount');

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

        $x = $this->get_income_graph('2024-03-01', '2024-12-30');
        // $x = $this->get_income_graph($startDate, $endDate);

        return view('be.pages.dashboard.index', compact(
            'endDate',
            'startDate',
            'userAmount',
            'brandAmount',
            'storeAmount',
            'totalIncome',
            'productAmount',
            'categoryAmount',
            'topSalesProduct',
            'topSalesCategory',
            'transactionAmount',
        ));
    }

    public function get_income_graph($startDate, $endDate)
    {
        $firstYear = explode('-', $startDate)[0];
        $lastYear  = explode('-', $endDate)[0];

        $firstMonth = explode('-', $startDate)[1];
        $lastMonth  = explode('-', $endDate)[1];

        $firstDate = explode('-', $startDate)[2];
        $lastDate  = explode('-', $endDate)[2];

        $tambahan = new ConTambahan();
        $arrMonth = $tambahan->get_month();

        foreach ($arrMonth as $month) {
            $keyMonth = $month['key'];
            $lastMonthDate = cal_days_in_month(CAL_GREGORIAN, $keyMonth, $lastYear);

            if ($keyMonth == $firstMonth) {
                $date = $firstDate;
            } else {
                $date = '01';
            }
            $dateFirst = $lastYear . '-' . $keyMonth . '-' . $date;
            $dateLast  = $lastYear . '-' . $keyMonth . '-' . $lastMonthDate;

            $getIncome = DB::table('transactions')
                ->whereBetween('transaction_date', array($dateFirst, $dateLast))
                ->where('is_paid', 1)
                ->sum('total_amount');

            $incomeSales[] = array(
                'key_month' => $month['key'],
                'month' => $month['bulan'],
                'total' => $getIncome
            );
        }
        // foreach ($arrMonth as $val_bln) {
        //     $income = 0;
        //     foreach ($incomeSales as $val) {
        //         $month = $val['key_month'];
        //         $total = $val['total'];

        //         if ($month == $val_bln['key']) {
        //             $income += $total;
        //         }
        //     }
        //     $realIncome[] = array(
        //         'key_bulan' => $val_bln['key'],
        //         'bulan' => $val_bln['bulan'],
        //         'total' => $income
        //     );
        // }
        // dd($incomeSales);
        return $incomeSales;
    }
}
