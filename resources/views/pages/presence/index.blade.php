@extends('layout.main')

@section('content')

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">
                            Daftar Kegiatan
                        </h4>
                    </div>
                    <div class="col">
                        <a href="{{ route('presence.create') }}" class="btn btn-primary float-end">
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Waktu Kegiatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($presences->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data kegiatan.</td>
                            </tr>
                        @endif
                        @foreach ($presences as $presence)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presence->nama_kegiatan }}</td>
                                <td>{{ date('d-m-Y', strtotime($presence->tgl_kegiatan)) }}</td>
                                <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                                <td>
                                    <a href="{{ route('presence.show', $presence->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                    <a href="{{ route('presence.edit', $presence->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('presence.destroy', $presence->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
