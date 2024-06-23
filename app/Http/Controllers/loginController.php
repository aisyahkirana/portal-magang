<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
use Hash;
Use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Traits\HasRoles;
use View;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function adminlogin(){
        return view('adminlogin');
    }

    public function dashboard(){
        return view('dashboard');
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
            if(Auth::user()->roles->pluck('mahasiswa')){
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('admin.index');
            }
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
        return redirect()->route('admin.dashboard');
    }

    }
}
