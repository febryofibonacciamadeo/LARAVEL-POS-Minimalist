<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function index() {
        $data = DB::select("SELECT * FROM customer ORDER BY customer_id DESC");
        return view('customer.index', compact('data'));
    }
    public function form_add() {
        return view('customer.add');
    }
    public function handle_add(Request $request) {
        $request->validate([
            'customer_name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'membership_number' => 'required',
            'expected_date' => 'required',
            'note' => 'required'
        ]);
        $customerIdNew = DB::select("SELECT dbo.getIdCustomer(?) AS customerIdNew", [$request->customer_name])[0]->customerIdNew;
        DB::table('customer')->insert([
            'customer_id' => $customerIdNew,
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'contact' => $request->contact,
            'membership_number' => $request->membership_number,
            'prod_name' => '',
            'note' => $request->note,
            'expected_date' => $request->expected_date
        ]);
        return redirect('/Customer')->with('success', 'Data customer berhasil ditambahkan!');
    }
    public function form_edit($customer_id) {
        $customer = DB::select("SELECT * FROM customer WHERE customer_id = ".$customer_id);
        return view('customer.edit', compact('customer'));
    }
    public function handle_edit(Request $request, $customer_id) {
        $request->validate([
            'customer_name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'membership_number' => 'required',
            'expected_date' => 'required',
            'note' => 'required'
        ]);
        DB::table('customer')->where('customer_id', $customer_id)->update([
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'contact' => $request->contact,
            'membership_number' => $request->membership_number,
            'prod_name' => '',
            'note' => $request->note
        ]);
        return redirect('/Customer')->with('success', 'Data customer berhasil diubah!');
    }
    public function handle_delete($customer_id) {
        DB::table('customer')->where('customer_id', $customer_id)->delete();
        return redirect('/Customer')->with('success', 'Data customer berhasil dihapus!');
    }
}
