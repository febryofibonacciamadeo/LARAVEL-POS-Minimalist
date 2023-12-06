<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function Dashboard() {
        $supplier = DB::select("SELECT * FROM supliers ORDER BY suplier_id DESC");
        $product = DB::select("SELECT * FROM products ORDER BY product_id DESC");
        return view('Dashboard', compact('supplier', 'product'));
    }
    public function data_penjualan() {
        $data = DB::select("SELECT name, sum(qty) AS qty FROM purchases_item GROUP BY name");
        return response()->json($data);
    }
}
