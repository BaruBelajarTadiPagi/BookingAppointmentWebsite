<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>

<style>
    .text-center {
        text-align: center;
    }
</style>

<body>
    <h1 class="text-center">{{ env('APP_NAME') }}</h1>

    <table class="table table-borderless">
        <tr >
            <td width="150">Nama Kegiatan</td>
            <td width="20">:</td>
            <td>{{ $presence->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td>Tanggal Kegiatan</td>
            <td>:</td>
            <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
        </tr>
        <tr>
            <td>Waktu Mulai</td>
            <td>:</td>
            <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
        </tr>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Asal Instansi</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>

        <tbody>
            @if ($presenceDetails->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data kegiatan.</td>
                </tr>
            @endif
            @foreach ($presenceDetails as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->nama }}</td>
                    <td>{{ $detail->jabatan }}</td>
                    <td>{{ $detail->asal_instansi }}</td>
                    <td>
                        <img src="{{ asset('uploads/' . $detail->signature) }}" width="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
