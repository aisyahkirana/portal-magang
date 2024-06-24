<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Models\Magang;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use PDF;

class HomeController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [
    //         'role_or_permission:admin'
    //     ];
    // }


    public function index()
    {
        $data = User::get();
        return view('index', compact('data'));
    }
    public function approval()
    {
        $data = Magang::get();
        return view('approval', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function pengajuan()
    {

        return view('pengajuan');
    }

    public function pengajuansubmit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'npm' => 'required',
            'universitas' => 'required',
            'jurusan' => 'required',
            'mulai_magang' => 'required',
            'selesai_magang' => 'required'
            //    'user_id' => 'required',
            //    'status' => 'required',
            //    'sertifikat' => 'required'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama'] = $request->nama;
        $data['npm'] = $request->npm;
        $data['universitas'] = $request->universitas;
        $data['jurusan'] = $request->jurusan;
        $data['mulai_magang'] = $request->mulai_magang;
        $data['selesai_magang'] = $request->selesai_magang;
        $data['user_id'] = $request->input('user_id');
        $data['status'] = $request->input('status');
        $data['sertifikat'] = $request->input('sertifikat');

        Magang::create($data);

        return redirect()->route('dashboard')->with('success', 'Data Anda Berhasil di Submit');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'photo' => 'mimes:png,jpg,jpeg|max:4196'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        // dd($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = date('Y-m-d') . $photo->getClientOriginalName();
            $path = 'photo-user/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
        } else {
            $filename = NULL;
        }


        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $data['image'] = $filename;


        User::create($data);

        return redirect()->route('admin.index')->with('success', 'Data Anda Berhasil di Submit');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'photo' => 'mimes:png,jpg,jpeg|max:4196'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = date('Y-m-d') . $photo->getClientOriginalName();
            $path = 'photo-user/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
        } else {
            $filename = NULL;
        }


        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['username'] = $request->username;
        $data['image'] = $filename;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        ;

        $test = User::where('id', $id)->update($data);

        return redirect()->route('admin.index')->with('success', 'Data Anda Berhasil di Update');
    }

    public function delete(Request $request)
    {
        ;
        $data = User::find($request->user_delete_id);


        if ($data) {
            $data->delete();
        }

        return redirect()->route('admin.index')->with('success', 'Data Anda Berhasil di Hapus');
    }
    public function approvalproses(Request $request)
    {

        // DB::connection()->enableQueryLog();
        $data = Magang::where('id', $request->user_id)->update(array('status' => 'Approve'));

        return redirect()->route('admin.approval')->with('success', 'Data User Ini Berhasil di Setujui');
    }

    public function notapprovalproses(Request $request)
    {
        // dd($request);

        // DB::connection()->enableQueryLog();
        $data = Magang::where('id', $request->user_id2)->update(array('status' => 'TidakApprove'));

        return redirect()->route('admin.approval')->with('danger', 'Data User Ini Berhasil di Tolak');
    }

    public function generatePDF()
    {
        $users = Magang::where('user_id', '=', Auth::user()->id)->get();
    
        $data = [
            'name' => 'Approval Magang',
            'title' => 'Approval Magang',
            'date' => date('dd/mm/Y'),
            'users' => $users
        ]; 
 
        $pdf = PDF::loadView('pdf.document', $data);
       
        return $pdf->stream('Dokumen Approval Magang Otak Kanan - '.$users[0]->nama.'.pdf');
    }
}
