<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $perbandinganData = DB::table('claims as c')
            ->leftJoin('patients as p', 'c.no_rm', '=', 'p.no_rm')
            ->select(
                'c.nama_lengkap',
                'c.no_rm',
                'c.no_bpjs',
                'c.alamat',
                'c.total_klaim',
                'p.total_estimasi',
                DB::raw('CASE WHEN COALESCE(p.total_estimasi, 0) > c.total_klaim THEN 1 ELSE 0 END as is_exceeded')
            )
            ->whereNotNull('c.total_klaim')
            ->orderBy('c.created_at', 'desc')
            ->get();

        return view('dashboard', compact('perbandinganData'));
    }
}
