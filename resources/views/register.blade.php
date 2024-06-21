<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <a href="#" class="h1 text-warning"><b>Portal</b> Magang</a>
              </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan mendaftarkan diri Anda</p>
                <form action="{{ route('registerproses') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        placeholder="Masukkan Email">
                    @error('email')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                        placeholder="Masukkan Nama">
                    @error('nama')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputUsername"
                        placeholder="Masukkan Username">
                    @error('username')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                    @error('password')
                    <small>{{ $message }}</small>
                    @enderror

                </div>
                <!-- /.social-auth-links -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>

                <p class="mb-0 mt-3">
                    <a href="{{ route('login')}}" class="text-center">Sudah Punya Akun? Klik untuk Login</a>
                </p>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($message = Session::get('success'))
    <script>
        Swal.fire("{{ $message }}");
    </script>
    @endif


    @if($message = Session::get('failed'))
    <script>
        Swal.fire("{{ $message }}");
    </script>
    @endif
</body>

</html>