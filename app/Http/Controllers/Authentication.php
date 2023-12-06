<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class Authentication extends Controller
{
    public function viewLogin() {
        return view('auth.login');
    }
    public function viewRegister() {
        return view('auth.register');
    }
    public function viewRegisterToko() {
        return view('auth.register_toko');
    }
    public function handleLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $Auth = DB::select("SELECT * FROM users WHERE email = '".$request->email."' AND password = '".$request->password."' ");
        if(count($Auth) > 0 || count($Auth) !== 0) {
            foreach($Auth as $data) {
                $idUser = $data->id;
                $email = $data->email;
                $password = $data->password;
                $nama = $data->name;
                $posisi = $data->position;
            }
            $request->session()->put('DataLogin', [
                'id' => $idUser,
                'email' => $email,
                'password' => $password,
                'nama' => $nama,
                'posisi' => $posisi
            ]);
            return redirect('/');
        }else{
            return redirect()->back()->with('failed', 'Login gagal!, Silahkan cek kembali usernmae dan password anda.');
        }
    }
    public function handleRegister(Request $request) {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'position' => 'required'
        ]);
        $idUserNew = DB::select("SELECT dbo.getIdUser(?) AS idUserNew", [$request->email])[0]->idUserNew;
        if($request->password == $request->password_confirmed) {    
            DB::table('users')->insert([
                'id' => $idUserNew,
                'email' => $request->email,
                'password' => $request->password,
                'name' => $request->nama,
                'position' => $request->position
            ]);
            return redirect('/Login')->with('success', 'Registerasi berhasil!, silahkan login dengan akun anda.');
        }else{
            return redirect()->back()->with('failed', 'Registerasi gagal!, harap cek kembali data anda.');
        }
    }
    public function Logout(Request $request) {
        $request->session()->forget('DataLogin');
        return redirect('/');
    }
}
