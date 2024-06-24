<!DOCTYPE html>
<html>

<head>
    @foreach ($users as $title)
        <title>Approval Magang a.n {{ $title->nama }}</title>
    @endforeach
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                <h1>Approval Magang</h1>
                <h4>Otak Kanan</h4>
                <hr class="mr-5" />
            </div>
        </div>

        <p>Halo!</p>
        <p><strong>Selamat! Anda lolos untuk dapat melakukan magang di Otak Kanan!</strong></p>
        <p>Anda dapat membawa dokumen ini untuk diberikan ke kami pada saat hari pertama Magang. Mohon untuk dicek
            kembali jika ada ketidak sesuaian data pada dokumen ini</p>

        <table class="table table-bordered text-center table-sm">
            <tr>
                <th>Nama</th>
                <th>Universitas</th>
                <th>Jurusan</th>
                <th>NPM</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->universitas }}</td>
                    <td>{{ $user->jurusan }}</td>
                    <td>{{ $user->npm }}</td>

                </tr>
            @endforeach
        </table>

        <p>Jika ada tidak kesesuaian data pada dokumen ini, kamu bisa sampaikan pada saat hari pertama magang</p>
        <div class="col-10 text-right">
            <div class="row">
                <h5>Otak Kanan</h4>
            </div>
        </div>
        <hr class="mr-5" />
        <footer class="flex-shrink-0 ">
        <div class="container text-center">
            <small>Dokumen ini di download pada tanggal {{$date}}</small>
        </div>
    </footer>
    </div>
    
</body>

</html>
