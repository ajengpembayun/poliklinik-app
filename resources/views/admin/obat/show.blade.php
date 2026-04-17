<x-layouts.app title="Detail Obat">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Detail Obat</h2>
        <div class="flex gap-2">
            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none">
                Edit
            </a>
            <a href="{{ route('obat.index') }}" class="btn btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-md border rounded-xl">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="font-semibold">Nama Obat:</span> {{ $obat->nama_obat }}</div>
                <div><span class="font-semibold">Harga:</span> Rp {{ number_format($obat->harga, 0, ',', '.') }}</div>
                <div class="md:col-span-2"><span class="font-semibold">Kemasan:</span> {{ $obat->kemasan ?? '-' }}</div>
            </div>
        </div>
    </div>
</x-layouts.app>
