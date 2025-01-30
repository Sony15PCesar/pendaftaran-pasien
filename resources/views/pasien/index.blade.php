@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">📋 Data Pasien</div>
        <div class="card-body">
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">➕ Tambah Pasien</a>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No. MR</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien as $p)
                    <tr>
                        <td>{{ $p->no_medical_record }}</td>
                        <td>{{ $p->no_ktp }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->tanggal_lahir }}</td>
                        <td>{{ $p->jenis_kelamin }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $p->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                            <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">🗑️ Hapus</button>
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
