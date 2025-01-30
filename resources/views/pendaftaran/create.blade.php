@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pendaftaran Rawat Jalan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('pendaftaran.store') }}">
        @csrf

        <!-- Input Pencarian Pasien -->
        <div class="mb-3">
            <label>Pilih Pasien</label>
            <div class="input-group">
                <input type="text" id="searchPasien" class="form-control" placeholder="Cari Nama, No. KTP, atau No. Rekam Medis" autocomplete="off">
                <input type="hidden" name="pasien_id" id="pasien_id">
                <button type="button" id="btnSearch" class="btn btn-primary">🔍 Cari</button>
            </div>

            <!-- Hasil Pencarian -->
            <div id="resultPasien" class="list-group mt-2" style="border: 1px solid #ddd; border-radius: 5px; padding: 5px; display: none;"></div>
        </div>

        <div class="mb-3">
            <label>Poli Tujuan</label>
            <select name="poli_tujuan" class="form-control" required>
                <option value="Poli Umum">Poli Umum</option>
                <option value="Poli Gigi">Poli Gigi</option>
                <option value="Poli Anak">Poli Anak</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Dokter Tujuan</label>
            <input type="text" name="dokter_tujuan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Ketika mengetik di input search
    $('#searchPasien').on('keyup', function() {
        let query = $(this).val();
        if (query.length >= 2) { // Mulai mencari setelah 2 huruf diketik
            cariPasien(query);
        } else {
            $('#resultPasien').html(""); // Kosongkan hasil jika input kosong
            $('#resultPasien').hide(); // Sembunyikan hasil pencarian
        }
    });

    // Ketika klik tombol cari
    $('#btnSearch').on('click', function() {
        let query = $('#searchPasien').val();
        if (query.length >= 2) {
            cariPasien(query);
        } else {
            alert('Masukkan minimal 2 karakter untuk mencari pasien.');
        }
    });

    // Fungsi untuk memanggil pencarian pasien
    function cariPasien(query) {
        $.ajax({
            url: "{{ route('pasien.search') }}", // Pastikan URL sudah benar
            type: "GET",
            data: { search: query },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
            },
            success: function(data) {
                if (data.length > 0) {
                    let resultHtml = '';
                    data.forEach(function(pasien) {
                        resultHtml += `
                            <div class="list-group-item select-pasien" data-id="${pasien.id}" data-nama="${pasien.nama}">
                                ${pasien.nama} - ${pasien.no_ktp} - ${pasien.no_medical_record}
                            </div>
                        `;
                    });
                    $('#resultPasien').html(resultHtml).show(); // Menampilkan hasil pencarian
                } else {
                    $('#resultPasien').html('<div class="list-group-item">Tidak ada pasien ditemukan.</div>').show();
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error: ' + status + ' ' + error);
            }
        });
    }

    // Ketika klik pada pasien yang ditemukan
    $(document).on('click', '.select-pasien', function() {
        let pasien_id = $(this).data('id');
        let pasien_nama = $(this).data('nama');
        $('#searchPasien').val(pasien_nama); // Set nama pasien di input
        $('#pasien_id').val(pasien_id); // Set ID pasien di hidden input
        $('#resultPasien').html(""); // Sembunyikan hasil pencarian
        $('#resultPasien').hide();
    });
});

</script>
@endsection
