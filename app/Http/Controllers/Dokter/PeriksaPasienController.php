<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        $daftarPasien = DaftarPoli::with(['pasien', 'jadwalPeriksa', 'periksa'])
            ->whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->orderBy('no_antrian')
            ->get();

        return view('dokter.periksa-pasien.index', compact('daftarPasien'));
    }

    public function create($id)
    {
        $obats = Obat::all();
        return view('dokter.periksa-pasien.create', compact('obats', 'id'));
    }

    public function store(Request $request)
{
    $request->validate([
        'obat_json' => 'required',
        'catatan' => 'nullable|string',
        'biaya_periksa' => 'required|integer',
    ]);

    $obatIds = json_decode($request->obat_json, true);

    try {

        DB::transaction(function () use ($request, $obatIds) {
    
            $periksa = Periksa::create([
                'id_daftar_poli' => $request->id_daftar_poli,
                'tgl_periksa' => now(),
                'catatan' => $request->catatan,
                'biaya_periksa' => $request->biaya_periksa + 150000,
            ]);
    
            foreach ($obatIds as $idObat) {
    
                $obat = Obat::find($idObat);
    
                if ($obat->stok <= 0) {
                    throw new \Exception("Stok {$obat->nama_obat} habis.");
                }
    
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $idObat,
                ]);
    
                $obat->decrement('stok');
            }
    
        });
    
    } catch (\Exception $e) {
    
        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    
    }
    
    return redirect()->route('periksa-pasien.index')
        ->with('success', 'Data pemeriksaan berhasil disimpan.');
}
} 