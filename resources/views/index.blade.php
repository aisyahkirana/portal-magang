@extends('layout.main')
@section('content')

<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ url('admin/delete') }}" method="POST">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_delete_id" id="delete_user_id">
        <p>Apakah anda yakin ingin menghapus data user ini?</p>
      </div>
      <div class="modal-footer justify-content-between">
       
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Ya, Hapus</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible col-md-4 col-md-offset-4">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Informasi</h5>
            <strong>{!! \Session::get('success') !!}</strong>
          </div>
          @endif
          <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

          <div class="card">

            <div class="card-header">
              <h3 class="card-title"><strong>Data User Portal Magang</strong></h3>

              <div class="card-tools">
                
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table id="example2" class="table table-bordered table-striped" style="width: 100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Foto Profil</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->name }}</td>
                    @if(empty($d->username))
                    <td>-</td>
                    @else
                    <td>{{ $d->username }}</td>
                    @endif
                    @if(empty($d->image))
                    <td><span class="badge badge-pill badge-danger">User Belum upload Foto</td>
                    @else
                    <td><img src="{{ asset('storage/photo-user/'.$d->image) }}" alt="#" width="100"></td>
                    @endif
                 
                    <td>{{ $d->email }}</td>
                    <td>
                      <a href="{{ route('admin.user.edit',['id' => $d->id]) }}" class="btn btn-primary"><i
                          class="fas fa-pen"></i> Edit</a>
                      <button type="button" value="{{ $d->id }}" class="btn btn-danger deleteCategoryBtn"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </td>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function (){
    $(document).on('click','.deleteCategoryBtn',function (e) 
    {
      e.preventDefault();


      var delete_id = $(this).val();
      $('#delete_user_id').val(delete_id);
      $('#deleteModal').modal('show');
    });
  });

</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      columnDefs: [{
        targets: '_all',
        className: 'mr-3 text-right'
       }],
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection