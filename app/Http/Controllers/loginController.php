<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
use Hash;
Use App\Models\User;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($data)){
            return redirect()->route('admin.index');
        }else{
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Anda berhasil Logout');
    }
    public function register(){
        return view('register');
    }

    public function register_proses(Request $request){
       $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'username' => 'required',
        'password' => 'required'
       ]);

       $data['email'] = $request->email;
       $data['name'] = $request->nama;
       $data['username'] = $request->username;
       $data['password'] = Hash::make($request->password);

       User::create($data);
       //submit data to database

       $data = [
        'email'     => $request->email,
        'password'  => $request->password,
     ];

    if(Auth::attempt($data)){
        return redirect()->route('admin.index');
    }

    }
}
