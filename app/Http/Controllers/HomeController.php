<?php

namespace App\Http\Controllers;
Use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use Hash;

class HomeController extends Controller
{

    public function dashboard(){
        return view('dashboard');
    }

    public function index(){
        $data = User::get();
        return view('index', compact('data'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'photo'    => 'mimes:png,jpg,jpeg|max:4196'
        ]);
        
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        // dd($request->all());
        if($request->hasFile('photo')){
        $photo  = $request->file('photo');
        $filename = date('Y-m-d').$photo->getClientOriginalName();
        $path   = 'photo-user/'.$filename;
        Storage::disk('public')->put($path,file_get_contents($photo));
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

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit',compact('data'));
    }

    public function update(Request $request,$id){
        // dd($request);
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'photo'    => 'mimes:png,jpg,jpeg|max:4196'
        ]);
       
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
       
        if($request->hasFile('photo')){
            $photo  = $request->file('photo');
            $filename = date('Y-m-d').$photo->getClientOriginalName();
            $path   = 'photo-user/'.$filename;
            Storage::disk('public')->put($path,file_get_contents($photo));
            } else {
            $filename = NULL;
            }
       

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['username'] = $request->username;
        $data['image'] = $filename;

        if($request->password){
            $data['password'] = Hash::make($request->password);
        };
       
       $test= User::where('id',$id)->update($data);
    
        return redirect()->route('admin.index')->with('success', 'Data Anda Berhasil di Update');
    }

    public function delete(Request $request){
     ;
        $data = User::find($request->user_delete_id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index')->with('success', 'Data Anda Berhasil di Hapus');
    }
}
