<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConTambahan extends Controller
{
    public function get_delivery_type()
    {
        $deliveryType = array(
            array(
                'id'    => 'pickupstore',
                'value' => 'Pickup Store',
            ),
            array(
                'id'    => 'others',
                'value' => 'Others',
            ),
        );
        return $deliveryType;
    }

    public function get_is_paid()
    {
        $deliveryType = array(
            array(
                'id'    => 0,
                'value' => 'Not Paid',
            ),
            array(
                'id'    => 1,
                'value' => 'Paid',
            ),
        );
        return $deliveryType;
    }
    public function get_month()
    {
        $arrayMonth = array(
            array(
                'key' => '01',
                'bulan' => 'Januari',
            ),
            array(
                'key' => '02',
                'bulan' => 'Februari',
            ),
            array(
                'key' => '03',
                'bulan' => 'Maret',
            ),
            array(
                'key' => '04',
                'bulan' => 'April',
            ),
            array(
                'key' => '05',
                'bulan' => 'Mei',
            ),
            array(
                'key' => '06',
                'bulan' => 'Juni',
            ),
            array(
                'key' => '07',
                'bulan' => 'Juli',
            ),
            array(
                'key' => '08',
                'bulan' => 'Agustus',
            ),
            array(
                'key' => '09',
                'bulan' => 'September',
            ),
            array(
                'key' => '10',
                'bulan' => 'Oktober',
            ),
            array(
                'key' => '11',
                'bulan' => 'November',
            ),
            array(
                'key' => '12',
                'bulan' => 'Desember',
            ),
        );
        return $arrayMonth;
    }
}
