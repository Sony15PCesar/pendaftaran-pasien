@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">🏥 Dashboard Pegawai</div>
        <div class="card-body">
            <a href="{{ route('pasien.index') }}" class="btn btn-primary">📋 Data Pasien</a>
            <a href="{{ route('pendaftaran.create') }}" class="btn btn-success">➕ Daftar Rawat Jalan</a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">🚪 Logout</button>
            </form>

            <hr>

            <h4>📋 Daftar Pasien Rawat Jalan</h4>

            @if ($pasienRawatJalan->isEmpty())
                <div class="alert alert-warning">Belum ada pasien yang terdaftar.</div>
            @else
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>No. Antrian</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Tanggal Daftar</th>
                            <th>Poli Tujuan</th>
                            <th>Dokter Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasienRawatJalan as $pasien)
                        <tr>
                            <td>{{ $pasien->nomor_antrian }}</td>
                            <td>{{ $pasien->no_medical_record }}</td>
                            <td>{{ $pasien->nama_pasien }}</td>
                            <td>{{ $pasien->jenis_kelamin }}</td>
                            <td>{{ $pasien->tanggal_lahir }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->tanggal_daftar }}</td>
                            <td>{{ $pasien->poli_tujuan }}</td>
                            <td>{{ $pasien->dokter_tujuan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pasienRawatJalan->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
