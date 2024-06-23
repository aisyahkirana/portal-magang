@extends('layout.main')
@section('content')

<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ url('admin/approvalproses') }}" method="POST">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Persetujuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_id" id="delete_user_id">
        <p>Apakah anda yakin ingin menyetujui pengajuan dari data user ini?</p>
      </div>
      <div class="modal-footer justify-content-between">
       
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Ya, Setuju</button>
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
          <h1 class="m-0">Approval Magang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Approval Pengajuan Magang</li>
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
          <div class="card">

            <div class="card-header">
              <h3 class="card-title"><strong>Data User Pengajuan Approval</strong></h3>

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
                          <th>Universitas</th>
                          <th>Jurusan</th>
                          <th>NPM</th>
                          <th>Mulai Magang</th>
                          <th>Selesai Magang</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $d)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama }}</td>
                        @if(empty($d->universitas))
                        <td>-</td>
                        @else
                        <td>{{ $d->universitas }}</td>
                        @endif
                        <td>{{ $d->jurusan }}</td>
                        <td>{{ $d->npm }}</td>
                        <td>{{ $d->mulai_magang }}</td>
                        <td>{{ $d->selesai_magang }}</td>
                        @if($d->status == 'notApprove')
                        <td> <button type="button" value="{{ $d->id }}" class="btn btn-warning deleteCategoryBtn"><i class="fas fa-check"></i> Setuju</button></td>
                        @else
                        <td><span class="badge badge-pill badge-success">Pengajuan User ini Telah Disetujui</td>
                        @endif
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
      var user_id = $(this).val();
      $('#delete_user_id').val(user_id);
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