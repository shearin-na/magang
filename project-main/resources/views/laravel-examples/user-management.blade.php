@extends('layouts.user_type.auth')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto"></div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">{{ __('ESTIMASI BIAYA PASIEN') }}</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <h5>Form Laporan Biaya Pasien</h5>
                </div>
                <div class="card-body">
                    <form id="biayaForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rm">No RM</label>
                                    <select class="form-control select2" name="no_rm" id="no_rm" required>
                                        <option value="">Pilih No RM</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->no_rm }}">{{ $patient->no_rm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Pendaftaran & Administrasi</label>
                                    <input type="number" class="form-control" name="biaya_pendaftaran_administrasi" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Akomodasi Rawat Inap</label>
                                    <input type="number" class="form-control" name="biaya_akomodasi_rawat_inap" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Pemeriksaan & Konsultasi</label>
                                    <input type="number" class="form-control" name="biaya_pemeriksaan_konsultasi" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Tindakan Medis</label>
                                    <input type="number" class="form-control" name="biaya_tindakan_medical" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Ibu, Bayi dan Balita</label>
                                    <input type="number" class="form-control" name="biaya_ibu_bayi_balita" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Biaya Obat & Bahan Medis</label>
                                    <input type="number" class="form-control" name="biaya_obat_bahan_medis" required>
                                </div>
                            </div>
                        </div>

                        <div class="alert" id="biayaAlert" style="display: none;"></div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn bg-gradient-primary" id="btnCekBiaya">Cek Biaya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('#no_rm').select2({
        placeholder: 'Cari No RM...',
        allowClear: true,
        width: '100%'
    });

    // Event handler untuk button Cek Biaya
    $('#btnCekBiaya').on('click', function(e) {
        e.preventDefault();
        
        // Ambil semua nilai input
        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            no_rm: $('#no_rm').val(),
            biaya_pendaftaran_administrasi: $('input[name="biaya_pendaftaran_administrasi"]').val() || 0,
            biaya_akomodasi_rawat_inap: $('input[name="biaya_akomodasi_rawat_inap"]').val() || 0,
            biaya_pemeriksaan_konsultasi: $('input[name="biaya_pemeriksaan_konsultasi"]').val() || 0,
            biaya_tindakan_medical: $('input[name="biaya_tindakan_medical"]').val() || 0,
            biaya_ibu_bayi_balita: $('input[name="biaya_ibu_bayi_balita"]').val() || 0,
            biaya_obat_bahan_medis: $('input[name="biaya_obat_bahan_medis"]').val() || 0
        };

        $.ajax({
            url: '/patients/check-limit',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                if (result.status === 'success') {
                    const comp = result.comparison;
                    const alertClass = comp.status === 'exceeded' ? 'alert-danger' : 'alert-success';
                    
                    $('#biayaAlert')
                        .removeClass('alert-danger alert-success')
                        .addClass(alertClass)
                        .html(`
                            <h6 class="mb-3">Hasil Pengecekan Biaya:</h6>
                            <div class="mb-3">
                                <p class="mb-2"><strong>Total Estimasi Biaya:</strong> Rp. ${comp.total_estimasi.toLocaleString('id-ID')}</p>
                                <p class="mb-2"><strong>Total Klaim:</strong> Rp. ${comp.total_klaim.toLocaleString('id-ID')}</p>
                                <p class="mb-2"><strong>Persentase Penggunaan:</strong> ${comp.persentase}%</p>
                                <p class="mb-2"><strong>Selisih:</strong> Rp. ${comp.selisih.toLocaleString('id-ID')}</p>
                            </div>
                            <div class="alert ${alertClass} mb-0">
                                ${result.message}
                            </div>
                        `)
                        .show();
                } else {
                    alert(result.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.log('Response:', xhr.responseText);
                alert('Terjadi kesalahan saat memeriksa biaya. Silakan coba lagi.');
            }
        });
    });
});
</script>

@endsection




