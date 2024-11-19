@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto"></div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">{{ __('KLAIM BPJS PASIEN') }}</h5>
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

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Input Data Pasien') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('claims.index') }}" method="POST" role="form text-left">
                    @csrf

                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">{{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama_lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_rm">No RM</label>
                                <input class="form-control" type="text" name="no_rm" pattern="[0-9]{5}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_bpjs">No BPJS</label>
                                <input class="form-control" type="text" name="no_bpjs" pattern="[0-9]{13}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_sep">No SEP</label>
                                <input class="form-control" type="text" name="no_sep" pattern="[0-9]{5}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas_pasien">Kelas Pasien</label>
                                <select id="kelas_pasien" class="form-control" name="kelas_pasien" required>
                                    <option value="">-- Pilih Kelas Pasien --</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input class="form-control" type="date" name="tanggal" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">    
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diagnosa">Diagnosa</label>
                                <select id="diagnosa-select" class="form-control" name="diagnosa" required>
                                    <option value="">-- Pilih Diagnosa --</option>
                                    <option value="meningitis">MENINGITIS TANPA DIKETAHUI PENYEBABNYA</option>
                                    <option value="extrapyramidal">EXTRAPYRAMIDAL</option>
                                    <option value="epilepsy">EPILEPSY</option>
                                    <option value="status_epilepticus">STATUS EPILEPTICUS</option>
                                    <option value="tth">TTH</option>
                                    <option value="polyneuropathy">POLYNEUROPATI</option>
                                    <option value="cerebral_palsy">CEREBRAL PALSY (CP)</option>
                                    <option value="tetraplegia">TETRAPLEGIA</option>
                                    <option value="hydrocephalus">HYDROCEPHALUS</option>
                                    <option value="encephalopathy">ENCEPHALOPATHY</option>
                                    <option value="cerebral_edema">CEREBRAL DEDEMA</option>
                                    <option value="konjungtivitis">KONJUNGTIVITIS AKUT</option>
                                    <option value="vertigo">VERTIGO OF CENTRAL ORIGIN</option>
                                    <option value="tinnitus">TINNITUS</option>
                                    <option value="heart_disease">HEART DISEASE</option>
                                    <option value="perdarahan_intracerebral">PERDARAHAN INTRACEREBRAL</option>
                                    <option value="post_stroke">POST STROKE</option>
                                    <option value="aneurysm">ANEURYSM</option>
                                    <option value="peripheral_vascular">PERIPHERAL VASCULAR DISEASE</option>
                                    <option value="dvt">DEEP VEIN THROMBOSIS</option>
                                    <option value="pharyngitis">PHARYNGITIS AKUT</option>
                                    <option value="bronchopneumonia">BRONCHOPNEUMONIA</option>
                                    <option value="pneumonia">PNEUMONIA</option>
                                    <option value="bronkitis">BRONKITIS AKUT</option>
                                    <option value="exacerbasi_ppok">EXACERBASI PPOK</option>
                                    <option value="asma_bronchial">ASMA BRONCHIAL</option>
                                    <option value="bronchiectasis">BRONCHIECTASIS</option>
                                    <option value="pyothorax">PYOTHORAX</option>
                                    <option value="efusi_pleura">EFUSI PLEURA</option>
                                    <option value="gingivitis">GINGIVITIS AKUT</option>
                                    <option value="sialoadenitis">SIALOADENITIS</option>
                                    <option value="stomatitis">STOMATITIS</option>
                                    <option value="gerd">GERD</option>
                                    <option value="ulcer_gastric">ULCER GASTRIC AKUT DENGAN PERDARAHAN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="klaim">Klaim</label>
                                <input class="form-control" name="klaim" required>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total-klaim">Total Klaim</label>
                                <!-- <p id="harga-diagnosa">Harga: Rp 0</p> -->
                                <p id="total-klaim">Total: Rp <span id="total-harga">0</span></p>
                                <input type="hidden" name="total_klaim" id="total_klaim_input">
                            </div>
                        </div>
                    </div>

                    <!-- Tambahkan CSS Select2 -->
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
                    <!-- Tambahkan JS jQuery dan Select2 -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

                    <!-- Inisialisasi Select2 -->
                    <script>
    $(document).ready(function() {
        $('#diagnosa-select').select2({
            placeholder: '-- Pilih Diagnosa --',
            width: '100%'
        });

        const hargaKelas = {
            1: 100000, // Kelas 1
            2: 80000,  // Kelas 2
            3: 60000,  // Kelas 3
            4: 40000   // Kelas 4
        };

        const hargaDiagnosa = {
            meningitis: 500000,
            extrapyramidal: 300000,
            epilepsy: 250000,
            status_epilepticus: 400000,
            tth: 150000,
            // Tambahkan harga untuk diagnosa lainnya
        };

        function updateHarga() {
            const kelas = $('#kelas_pasien').val();
            const hargaKelasPasien = hargaKelas[kelas] || 0;
            const diagnosa = $('#diagnosa-select').val();
            const hargaDiagnosaPilihan = hargaDiagnosa[diagnosa] || 0;
            const total = hargaKelasPasien + hargaDiagnosaPilihan;

            $('#harga-diagnosa').text('Harga: Rp ' + hargaDiagnosaPilihan);
            $('#total-harga').text(total);
            $('#total_klaim_input').val(total);

            // Kirim data ke server
            $.ajax({
                url: '/path/to/your/api/claim', // Ganti dengan endpoint yang sesuai
                method: 'POST',
                data: {
                    kelas: kelas,
                    diagnosa: diagnosa,
                    harga_diagnosa: hargaDiagnosaPilihan,
                    total_harga: total
                },
                success: function(response) {
                    console.log('Data berhasil dikirim:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }

        $('#kelas_pasien').change(updateHarga);
        $('#diagnosa-select').change(updateHarga);
    });
</script>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
