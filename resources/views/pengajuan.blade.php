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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form Pengajuan Magang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('pengajuansubmit') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-lg-12 col-12">
                        <!-- general form elements -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Form Pengajuan Magang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputnama">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputnama"
                                            placeholder="Masukkan Nama">
                                        @error('nama')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputnpm">NPM</label>
                                        <input type="text" name="npm" class="form-control" id="exampleInputnpm"
                                            placeholder="Masukkan NPM Anda">
                                        @error('npm')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuniversitas">Universitas</label>
                                        <input type="text" name="universitas" class="form-control"
                                            id="exampleInputuniversitas" placeholder="Masukkan Nama Universitas">
                                        @error('universitas')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputjurusan">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control"
                                            id="exampleInputUniversitas" placeholder="Masukkan Nama Jurusan">
                                        @error('jurusan')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputMulai">Mulai Magang</label>
                                        <input type="date" class="form-control" id="exampleInputMulai"
                                            name="mulai_magang">
                                        @error('mulai_magang')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEnd">Selesai Magang</label>
                                        <input type="date" class="form-control" id="exampleInputEnd" name="selesai_magang">
                                        @error('selesai_magang')
                                        <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <input type="hidden" class="form-control" name="status" value="notApprove">
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="hidden" class="form-control" name="sertifikat" value="notYet">
                                    @error('sertifikat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <input type="hidden" class="form-control" name="user_id"
                                        value="{{ Auth::user()->id; }}">
                                    @error('user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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