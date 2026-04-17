<x-layouts.app title="Detail Poli">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Detail Poli</h2>
        <div class="flex gap-2">
            <a href="{{ route('polis.edit', $poli->id) }}" class="btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none">
                Edit
            </a>
            <a href="{{ route('polis.index') }}" class="btn btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-md border rounded-xl">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-4 text-sm">
                <div><span class="font-semibold">Nama Poli:</span> {{ $poli->nama_poli }}</div>
                <div><span class="font-semibold">Keterangan:</span> {{ $poli->keterangan ?? '-' }}</div>
            </div>
        </div>
    </div>
</x-layouts.app>
