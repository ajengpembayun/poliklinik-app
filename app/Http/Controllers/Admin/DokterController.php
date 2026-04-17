<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|integer|exists:poli,id',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'no_ktp' => $data['no_ktp'],
            'no_hp' => $data['no_hp'],
            'id_poli' => $data['id_poli'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'dokter',
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data Dokter berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dokter = User::where('role', 'dokter')->with('poli')->findOrFail($id);
        return view('admin.dokter.show', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $dokter->id,
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|integer|exists:poli,id',
            'email' => 'required|string|unique:users,email,' . $dokter->id,
            'password' => 'nullable|string|min:6',
        ]);

        $dokter->nama = $data['nama'];
        $dokter->alamat = $data['alamat'];
        $dokter->no_ktp = $data['no_ktp'];
        $dokter->no_hp = $data['no_hp'];
        $dokter->id_poli = $data['id_poli'];
        $dokter->email = $data['email'];
        if (! empty($data['password'])) {
            $dokter->password = Hash::make($data['password']);
        }
        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Data Dokter berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data Dokter berhasil dihapus');
    }
}
