<x-layouts.app title="Detail Dokter">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Detail Dokter</h2>
        <div class="flex gap-2">
            <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none">
                Edit
            </a>
            <a href="{{ route('dokter.index') }}" class="btn btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-md border rounded-xl">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="font-semibold">Nama:</span> {{ $dokter->nama }}</div>
                <div><span class="font-semibold">Email:</span> {{ $dokter->email }}</div>
                <div><span class="font-semibold">No. KTP:</span> {{ $dokter->no_ktp ?? '-' }}</div>
                <div><span class="font-semibold">No. HP:</span> {{ $dokter->no_hp ?? '-' }}</div>
                <div><span class="font-semibold">Poli:</span> {{ $dokter->poli->nama_poli ?? '-' }}</div>
                <div><span class="font-semibold">Role:</span> {{ ucfirst($dokter->role) }}</div>
                <div class="md:col-span-2"><span class="font-semibold">Alamat:</span> {{ $dokter->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>
</x-layouts.app>
