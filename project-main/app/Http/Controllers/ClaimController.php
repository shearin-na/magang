<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Patient;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    // Menampilkan daftar klaim
    public function index()
    {
        // Mengambil semua klaim dan data pasien terkait menggunakan relasi 'no_rm'
        $claims = Claim::with('patient')->get();
        
        return view('claims.index', compact('claims'));
    }

    // Menampilkan form untuk menambah klaim
    public function create()
    {
        // Mengambil semua pasien untuk dropdown
        $patients = Patient::all();
        
        return view('claims.create', compact('patients'));
    }

    // Menyimpan data klaim baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_rm' => 'required|string|max:255',
            'no_bpjs' => 'required|string|max:255',
            'no_sep' => 'required|string|max:255',
            'kelas_pasien' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'alamat' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'total_klaim' => 'required|string|max:225'
        ]);

        // Simpan data ke database
        Claim::create($request->all());

        // Redirect atau return response
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    // Menampilkan form untuk mengedit klaim
    public function edit(Claim $claim)
    {
        // Mengambil semua pasien untuk dropdown
        $patients = Patient::all();
        
        return view('claims.edit', compact('claim', 'patients'));
    }

    // Memperbarui data klaim
    public function update(Request $request, Claim $claim)
    {
        // Validasi inputan
        $request->validate([
            'no_rm' => 'required|exists:patients,no_rm',  // Validasi no_rm sebagai foreign key
            'nama_lengkap' => 'required|string|max:255',
            'no_bpjs' => 'required|numeric|digits:13', // pastikan validasi sesuai dengan format
            'no_sep' => 'required|numeric|digits:5', // pastikan validasi sesuai dengan format
            'kelas_pasien' => 'required|integer',
            'tanggal' => 'required|date',
            'alamat' => 'required|string|max:255',
            'klaim' => 'required|numeric|min:0',
            'diagnosa' => 'required|string|max:255',
        ]);

        // Memperbarui klaim dengan data yang valid
        $claim->update($request->all());

        return redirect()->route('claims.index')->with('success', 'Klaim berhasil diperbarui.');
    }

    // Menghapus data klaim
    public function destroy(Claim $claim)
    {
        // Menghapus klaim yang dipilih
        $claim->delete();

        return redirect()->route('claims.index')->with('success', 'Klaim berhasil dihapus.');
    }
}