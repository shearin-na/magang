<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Claim::select('no_rm')->distinct()->get();
        return view('laravel-examples.user-management', compact('patients'));
    }

    public function checkLimit(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $request->validate([
                'no_rm' => 'required',
                'biaya_pendaftaran_administrasi' => 'required|numeric',
                'biaya_akomodasi_rawat_inap' => 'required|numeric',
                'biaya_pemeriksaan_konsultasi' => 'required|numeric',
                'biaya_tindakan_medical' => 'required|numeric',
                'biaya_ibu_bayi_balita' => 'required|numeric',
                'biaya_obat_bahan_medis' => 'required|numeric',
            ]);

            // Hitung total estimasi
            $totalEstimasi = 
                (float)$request->biaya_pendaftaran_administrasi +
                (float)$request->biaya_akomodasi_rawat_inap +
                (float)$request->biaya_pemeriksaan_konsultasi +
                (float)$request->biaya_tindakan_medical +
                (float)$request->biaya_ibu_bayi_balita +
                (float)$request->biaya_obat_bahan_medis;

            // Simpan atau update data estimasi biaya ke tabel patients
            $patient = Patient::updateOrCreate(
                ['no_rm' => $request->no_rm],
                [
                    'biaya_pendaftaran_administrasi' => $request->biaya_pendaftaran_administrasi,
                    'biaya_akomodasi_rawat_inap' => $request->biaya_akomodasi_rawat_inap,
                    'biaya_pemeriksaan_konsultasi' => $request->biaya_pemeriksaan_konsultasi,
                    'biaya_tindakan_medical' => $request->biaya_tindakan_medical,
                    'biaya_ibu_bayi_balita' => $request->biaya_ibu_bayi_balita,
                    'biaya_obat_bahan_medis' => $request->biaya_obat_bahan_medis,
                    'total_estimasi' => $totalEstimasi
                ]
            );

            // Cari data klaim
            $claim = Claim::where('no_rm', $request->no_rm)
                         ->whereNotNull('total_klaim')
                         ->latest()
                         ->first();

            if (!$claim) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data klaim tidak ditemukan'
                ], 404);
            }

            $totalKlaim = (float)$claim->total_klaim;
            $persentasePenggunaan = ($totalEstimasi / $totalKlaim) * 100;
            $selisih = $totalKlaim - $totalEstimasi;

            DB::commit();

            // Tentukan status dan pesan
            if ($totalEstimasi > $totalKlaim) {
                $status = 'exceeded';
                $message = sprintf(
                    'PERINGATAN: Total estimasi biaya melebihi batas klaim! (%.1f%% dari batas klaim)',
                    $persentasePenggunaan
                );
            } else {
                $status = 'within_limit';
                $message = sprintf(
                    'Total estimasi biaya masih dalam batas klaim (%.1f%% dari batas klaim)',
                    $persentasePenggunaan
                );
            }

            return response()->json([
                'status' => 'success',
                'comparison' => [
                    'total_estimasi' => $totalEstimasi,
                    'total_klaim' => $totalKlaim,
                    'selisih' => abs($selisih),
                    'persentase' => round($persentasePenggunaan, 1),
                    'status' => $status
                ],
                'message' => $message,
                'details' => [
                    'pendaftaran' => $request->biaya_pendaftaran_administrasi,
                    'akomodasi' => $request->biaya_akomodasi_rawat_inap,
                    'pemeriksaan' => $request->biaya_pemeriksaan_konsultasi,
                    'tindakan' => $request->biaya_tindakan_medical,
                    'ibu_bayi' => $request->biaya_ibu_bayi_balita,
                    'obat' => $request->biaya_obat_bahan_medis
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search($no_rm)
    {
        $patient = Patient::where('no_rm', $no_rm)
            ->with('claim')
            ->first();

        if ($patient) {
            return response()->json([
                'status' => 'success',
                'patient' => $patient
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Pasien tidak ditemukan'
        ], 404);
    }
}


