<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    function createRandomId() {
        $chars = "003232303232023232023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7) {
    
            $num = rand() % 33;
    
            $tmp = substr($chars, $num, 1);
    
            $pass = $pass . $tmp;
    
            $i++;
    
        }
        return $pass;
    }

    public function index(Request $request) {
        if(!isset(session('invoice')[0])) {
            $invoice = $this->createRandomId();
            $request->session()->put('invoice', $invoice);
        }else{
            $invoice = session('invoice');
        }        
        $product = DB::select("SELECT * FROM products ORDER BY product_id");
        $data = DB::select("SELECT * FROM sales_order WHERE invoice = ".$invoice);
        $amount = DB::select("SELECT sum(amount) AS total_amount FROM sales_order WHERE invoice = ".$invoice);
        foreach($amount as $amn) {
            $ttl_amount = $amn->total_amount;
        }
        if(count($data) > 0) {
            foreach($data as $dt) {
                $transaction_id = $dt->transaction_id;
            }
        }else{
            $transaction_id = 0;
        }
        $profit = DB::select("SELECT sum(profit) AS total_profit FROM sales_order WHERE invoice = ".$invoice);
        foreach($profit as $prof) {
            $ttl_profit = $prof->total_profit;
        }
        return view('sales.index', compact('invoice', 'product', 'data', 'amount', 'profit', 'transaction_id', 'ttl_profit', 'ttl_amount'));
    }

    public function incoming(Request $request) {
        $data = DB::select("SELECT * FROM products WHERE product_id = ".$request->product_id);
        foreach ($data as $data) {
            $price = $data->price;
            $product_code = $data->product_code;
            $gen_name = $data->gen_name;
            $product_name = $data->product_name;
            $profit = $data->profit;
            $qty = $data->qty;
            $expiry_date = $data->expiry_date;
            $product_category = $data->product_category;
        }
        $product = $product_code." - ".$product_name." - ".$gen_name." | Expires at: ".$expiry_date;
        $disc = 0;
        $amount = ($price-$disc) * $request->qty;
        $qty_now = $qty - $request->qty;
        $total_profit = $profit * $request->qty;
        DB::table('products')->where('product_id', $request->product_id)->update([
            'qty' => $qty_now
        ]);
        $date = DB::select("SELECT dbo.GetDateTimeLocal() AS date")[0]->date;
        $transaction_id = DB::select("SELECT dbo.getIdTransaction(?) AS transaction_id",[session('invoice')])[0]->transaction_id;
        DB::table('sales_order')->insert([
            'transaction_id' => $transaction_id,
            'invoice' => session('invoice'),
            'product' => $product,
            'qty' => $request->qty,
            'amount' => $amount,
            'name' => $product_name,
            'price' => $price,
            'product_code' => $product_code,
            'date' => $date,
            'profit' => $total_profit,
            'gen_name' => $gen_name,
            'product_category' => $product_category, 
            'discount' => $disc
        ]);
        return redirect()->back();
    }
    public function cancel($transaction_id, $product_code, $qty_count) {
        $data = DB::select("SELECT * FROM products WHERE product_code = ".$product_code);
        foreach ($data as $data) {
            $qty = $data->qty;
        }
        $qty_now = $qty + $qty_count;
        DB::table('products')->where('product_code', $product_code)->update([
            'qty' => $qty_now,
            'qty_sold' => $qty_now
        ]);
        DB::table('sales_order')->where('transaction_id', $transaction_id)->where('invoice', session('invoice'))->delete();
        return redirect()->back();
    }
    public function checkout(Request $request, $invoice) {
        $date = DB::select("SELECT dbo.GetDateTimeLocal() AS date")[0]->date;
        DB::table('sales')->insert([
            'transaction_id' => $request->transaction_id,
            'invoice_number' => $invoice,
            'cashier' => session('DataLogin')['nama'],
            'date' => $date,
            'due_date' => $date,
            'type' => 'cash',
            'profit' => $request->profit,
            'name' => $request->customer,
            'balance' => '',
            'amount' => $request->amount
        ]);
        $product_order = DB::select("SELECT * FROM sales_order WHERE invoice =".$invoice);
        foreach($product_order as $PO) {
            $id_purchases_item = DB::select("SELECT dbo.getIdPurchasesItem(?) AS id_purchases_item", [$PO->name])[0]->id_purchases_item;
            DB::table('purchases_item')->insert([
                'id' => $id_purchases_item,
                'name' => $PO->name,
                'qty' => $PO->qty,
                'cost' => $PO->amount,
                'invoice' => $invoice
            ]);
        }
        $data = DB::select('SELECT * FROM sales_order WHERE invoice = '.$invoice);
        $amount = DB::select("SELECT sum(amount) AS total_amount FROM sales_order WHERE invoice = ".$invoice)[0]->total_amount;
        $profit = DB::select("SELECT sum(profit) AS total_profit FROM sales_order WHERE invoice = ".$invoice);
        $change = $request->amount - $amount;
        $request->session()->forget('invoice');
        return view('struck', compact('data', 'change', 'amount', 'profit'));
    }
}





