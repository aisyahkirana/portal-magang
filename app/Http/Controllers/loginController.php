<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Traits\HasRoles;
use View;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function adminlogin()
    {
        return view('adminlogin');
    }

    public function dashboard()
    {
        DB::connection()->enableQueryLog();
        $datadashboard = Magang::where('user_id', '=', Auth::user()->id)->get();
        $dataMagang = Magang::where('status', '=', 'Approve')->count();

        $jumlah = Magang::count();
        // dd($jumlah);
        // DB::connection()->enableQueryLog();
        // $queries = DB::getQueryLog();

        // dd($queries);

        return view('dashboard', compact('datadashboard','jumlah','dataMagang'));
    }

    public function login_proses(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->roles->pluck('mahasiswa')) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil Logout');
    }
    public function register()
    {
        $roles = Role::pluck('name','name')->all();
        return view('register',compact('roles'));
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'password' => 'required',
            'roles' => 'required'
        ]);
     
        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);

        
        $user = User::create($data);
        $user->assignRole($request->input('roles'));

        //submit data to database

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->roles->pluck('mahasiswa')) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }

    }
}
