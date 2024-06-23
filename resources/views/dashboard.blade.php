@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang di <strong>Aplikasi Portal Magang</strong></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if (!empty($dataMagang))
                            <h3>{{$dataMagang}}</h3>
                            @else
                            <h3>0</h3>
                            @endif

                            <p>Total Approval Magang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bookmark"></i>
                        </div>

                    </div>
                </div>
               
                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$jumlah}}</h3>

                            <p>Mahasiswa Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    Anda dapat melakukan pengajuan Magang pada aplikasi ini
                </div>

               
                <!-- ./col -->
            </div>
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"><strong>Data Pengajuan Magang</strong></h3>

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
                                <th>Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datadashboard as $d)
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
                              <td><span class="badge badge-pill badge-danger">Pengajuan Anda belum Disetujui</td>
                             <td><span class="badge badge-pill badge-danger">Pengajuan Anda belum Disetujui</td>
                              @else
                              <td><span class="badge badge-pill badge-success">Pengajuan Anda telah Disetujui</td>
                                <td> <button type="button"  class="btn btn-success"><i class="fas fa-download"></i> Download Approval</button></td>
                              @endif
                              @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
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