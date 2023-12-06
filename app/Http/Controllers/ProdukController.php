<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    function createRandomId() {
        $chars = "002221223232303232023232023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i < 9) {
    
            $num = rand() % 33;
    
            $tmp = substr($chars, $num, 1);
    
            $pass = $pass . $tmp;
    
            $i++;
    
        }
        return $pass;
    }
    public function index() {
        $data = DB::select("SELECT *, price * qty AS total FROM products ORDER BY product_id DESC");
        return view('produk.index', compact('data'));
    }
    public function form_add() {
        $supplier = DB::select("SELECT * FROM supliers ORDER BY suplier_id DESC");
        return view('produk.add', compact('supplier'));
    }
    public function handle_add(Request $request) {
        $request->validate([
            'gen_name' => 'required',
            'product_name' => 'required',
            'product_category' => 'required',
            'o_price' => 'required',
            'price' => 'required',
            'supplier' => 'required',
            'profit' => 'required',
            'qty' => 'required',
            'qty_sold' => 'required',
            'date_arrival' => 'required',
            'expiry_date' => 'required',
        ]);
        $idProductNew = DB::select("SELECT dbo.getIdProduct(?) AS idProductNew", [$request->product_name])[0]->idProductNew;
        DB::table('products')->insert([
            'product_id' => $idProductNew,
            'product_code' => $this->createRandomId(),
            'gen_name' => $request->gen_name,
            'product_name' => $request->product_name,
            'product_category' => $request->product_category,
            'o_price' => $request->o_price,
            'price' => $request->price,
            'profit' => $request->profit,
            'supplier' => $request->supplier,
            'qty' => $request->qty,
            'qty_sold' => $request->qty_sold,
            'date_arrival' => $request->date_arrival,
            'expiry_date' => $request->expiry_date,
            'cost' => '',
            'onhand_qty' => 0
        ]);
        return redirect('/Produk')->with('success', 'Data produk berhasi ditambahkan!');
    } 
    public function form_edit($product_id) {
        $supplier = DB::select("SELECT * FROM supliers ORDER BY suplier_id DESC");
        $product = DB::select("SELECT * FROM products WHERE product_id = ".$product_id);
        return view('produk.edit', compact('supplier','product'));
    }
    public function handle_edit(Request $request, $product_id) {
        $request->validate([
            'product_code' => 'required',
            'gen_name' => 'required',
            'product_name' => 'required',
            'product_category' => 'required',
            'o_price' => 'required',
            'price' => 'required',
            'supplier' => 'required',
            'profit' => 'required',
            'qty' => 'required',
            'qty_sold' => 'required',
            'date_arrival' => 'required',
            'expiry_date' => 'required',
        ]);
        DB::table('products')->where('product_id', $product_id)->update([
            'product_code' => $request->product_code,
            'gen_name' => $request->gen_name,
            'product_name' => $request->product_name,
            'product_category' => $request->product_category,
            'o_price' => $request->o_price,
            'price' => $request->price,
            'profit' => $request->profit,
            'supplier' => $request->supplier,
            'qty' => $request->qty,
            'qty_sold' => $request->qty_sold,
            'date_arrival' => $request->date_arrival,
            'expiry_date' => $request->expiry_date,
            'cost' => '',
            'onhand_qty' => 0
        ]);
        return redirect('/Produk')->with('success', 'Data produk berhasi diubah!');
    }
    public function handle_delete($product_id) {
        DB::table('products')->where('product_id', $product_id)->delete();
        return redirect()->back()->with('success', 'Data produk berhasil dihapus!');
    }  
}
