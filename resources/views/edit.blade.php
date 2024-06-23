@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.user.update',['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
               <div class="row">
            <!-- left column -->
            <div class="col-lg-12 col-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Edit User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $data->email }}" placeholder="Masukkan Email">
                      @error('email')
                          <small>{{ $message }}</small>
                      @enderror                     
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputEmail1" value="{{ $data->name }}" placeholder="Masukkan Nama">
                        @error('nama')
                            <small>{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputUsername" value="{{ $data->name }}" placeholder="Masukkan Username">
                        @error('username')
                            <small>{{ $message }}</small>
                        @enderror
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      @error('password')
                          <small>{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Foto Profil</label>
                      <input type="file" class="form-control" id="exampleInputPhoto" name="photo">
                      @if(empty($data->image))
                      <td><span class="badge badge-pill badge-danger">User Belum upload Foto</td>
                      @else
                      <td><img src="{{ asset('storage/photo-user/'.$data->image) }}" width="100"></td>
                      @endif
                      @error('email')
                          <small>{{ $message }}</small>
                      @enderror                     
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </form>
              <!-- /.card -->
  
            </div>
            <!--/.col (left) -->
          </div> 
            </form>
          
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

  </div>
@endsection