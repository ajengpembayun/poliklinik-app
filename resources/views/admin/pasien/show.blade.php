<x-layouts.app title="Detail Pasien">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Detail Pasien</h2>
        <div class="flex gap-2">
            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none">
                Edit
            </a>
            <a href="{{ route('pasien.index') }}" class="btn btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-md border rounded-xl">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="font-semibold">Nama:</span> {{ $pasien->nama }}</div>
                <div><span class="font-semibold">Email:</span> {{ $pasien->email }}</div>
                <div><span class="font-semibold">No. KTP:</span> {{ $pasien->no_ktp ?? '-' }}</div>
                <div><span class="font-semibold">No. HP:</span> {{ $pasien->no_hp ?? '-' }}</div>
                <div><span class="font-semibold">No. RM:</span> {{ $pasien->no_rm ?? '-' }}</div>
                <div><span class="font-semibold">Role:</span> {{ ucfirst($pasien->role) }}</div>
                <div class="md:col-span-2"><span class="font-semibold">Alamat:</span> {{ $pasien->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>
</x-layouts.app>
