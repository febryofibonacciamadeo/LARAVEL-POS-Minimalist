<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
{
    public function index() {
        $data = DB::select("SELECT * FROM supliers ORDER BY suplier_id DESC");
        return view('supplier.index', compact('data'));
    }
    public function form_add() {
        return view('supplier.add');
    }
    public function handle_add(Request $request) {
        $request->validate([
            'suplier_name' => 'required',
            'suplier_address' => 'required',
            'suplier_contact' => 'required',
            'contact_person' => 'required',
            'note' => 'required'
        ]);
        $idSuplierNew = DB::select("SELECT dbo.getIdSuppliers(?) AS idSupplierNew", [$request->suplier_name])[0]->idSupplierNew;
        DB::table('supliers')->insert([
            'suplier_id' => $idSuplierNew,
            'suplier_name' => $request->suplier_name,
            'suplier_address' => $request->suplier_address,
            'suplier_contact' => $request->suplier_contact,
            'contact_person' => $request->contact_person,
            'note' => $request->note
        ]);
        return redirect('/Supplier')->with('success', 'Data supplier berhasil ditambahkan!');
    }
    public function form_edit($suplier_id) {
        $data = DB::select("SELECT * FROM supliers WHERE suplier_id = ".$suplier_id);
        return view('supplier.edit', compact('data'));
    }
    public function handle_edit(Request $request, $suplier_id) {
        $request->validate([
            'suplier_name' => 'required',
            'suplier_address' => 'required',
            'suplier_contact' => 'required',
            'contact_person' => 'required',
            'note' => 'required'
        ]);
        DB::table('supliers')->where('suplier_id', $suplier_id)->update([
            'suplier_name' => $request->suplier_name,
            'suplier_address' => $request->suplier_address,
            'suplier_contact' => $request->suplier_contact,
            'contact_person' => $request->contact_person,
            'note' => $request->note
        ]);
        return redirect('/Supplier')->with('success', 'Data supplier berhasil diubah!');
    }
    public function handle_delete($suplier_id) {
        DB::table('supliers')->where('suplier_id', $suplier_id)->delete();
        return redirect()->back()->with('success', 'Data supplier berhasil dihapus!');
    }
}
