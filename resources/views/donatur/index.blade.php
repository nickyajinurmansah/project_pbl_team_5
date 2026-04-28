@extends('layouts.app')
@section('header', 'Data Donatur')

@section('header_action')
    <button onclick="toggleSearchPanel()"
            class="px-8 py-2 bg-transparent border border-gray-500 text-gray-700 rounded-full text-sm font-medium hover:bg-white/30 transition">
        Search Donatur
    </button>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-full">

    {{-- KOLOM KIRI --}}
    <div class="md:col-span-8 flex flex-col gap-6">

        {{-- STATISTIK --}}
        <div class="flex gap-4">
            <div class="bg-[#4D7653] text-white p-5 rounded-lg w-32 md:w-40 shadow-sm flex flex-col justify-center">
                <h3 class="text-4xl font-bold text-center mb-1">{{ $totalDonatur ?? 0 }}</h3>
                <p class="text-xs text-center opacity-90">Total donatur</p>
            </div>
            <div class="bg-[#4D7653] text-white p-5 rounded-lg w-32 md:w-40 shadow-sm flex flex-col justify-center">
                <h3 class="text-4xl font-bold text-center mb-1">{{ $donaturTetap ?? 0 }}</h3>
                <p class="text-xs text-center opacity-90">Donatur tetap</p>
            </div>
        </div>

        {{-- Tombol Tambah Data --}}
        <div class="flex items-center">
            <a href="{{ route('donatur.create') }}"
               class="inline-flex bg-white border border-gray-300 text-gray-700 px-5 py-2 rounded-full shadow-sm text-sm font-semibold items-center gap-2 hover:bg-gray-50 transition">
                Tambah Data
                <span class="text-lg font-bold leading-none">+</span>
            </a>
        </div>

        {{-- PANEL PENCARIAN (Hidden by Default) --}}
        <div id="searchPanel" class="hidden bg-white rounded-xl p-4 shadow-sm border border-gray-200 animate-fade-in">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-[#4D7653] rounded-full flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <input type="text"
                           id="searchInput"
                           placeholder="Cari berdasarkan nama, email, atau no. HP..."
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#4D7653] focus:border-transparent"
                           onkeyup="filterDonatur()">
                </div>
                <button onclick="toggleSearchPanel()" class="p-2 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex gap-2 mt-3 flex-wrap">
                <button onclick="filterByStatus('all')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-[#4D7653] hover:text-white rounded-full transition">Semua</button>
                <button onclick="filterByStatus('aktif')" class="px-3 py-1 text-xs bg-green-100 text-green-700 hover:bg-[#4D7653] hover:text-white rounded-full transition">Aktif</button>
                <button onclick="filterByStatus('nonaktif')" class="px-3 py-1 text-xs bg-red-100 text-red-700 hover:bg-[#4D7653] hover:text-white rounded-full transition">Nonaktif</button>
            </div>
        </div>

        {{-- PANEL GRID DONATUR --}}
        <div class="bg-[#4D7653] rounded-xl p-5 shadow-sm flex-1">
            <h4 class="text-white text-sm font-medium mb-4">Data Donatur Tetap</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="donaturGrid">
                @forelse($donaturs as $donatur)
                <div class="donatur-card bg-white rounded-lg p-3 flex justify-between items-center shadow-sm min-h-[4.5rem] cursor-pointer hover:shadow-md transition"
                     data-nama="{{ strtolower($donatur->nama_donatur) }}"
                     data-email="{{ strtolower($donatur->email) }}"
                     data-hp="{{ strtolower($donatur->no_hp) }}"
                     data-status="{{ strtolower($donatur->status) }}"
                     onclick="showDetail(
                         '{{ addslashes($donatur->nama_donatur) }}',
                         '{{ addslashes($donatur->email) }}',
                         '{{ addslashes($donatur->no_hp) }}',
                         '{{ addslashes($donatur->status) }}',
                         '{{ $donatur->tanggal_bergabung ? \Carbon\Carbon::parse($donatur->tanggal_bergabung)->format('d M Y') : '-' }}',
                         '{{ $donatur->foto ? asset('storage/'.$donatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($donatur->nama_donatur).'&background=4D7653&color=fff&size=80' }}'
                     )">

                    {{-- KIRI: Foto + Info --}}
                    <div class="flex items-center gap-3 min-w-0">
                        <img src="{{ $donatur->foto
                                ? asset('storage/'.$donatur->foto)
                                : 'https://ui-avatars.com/api/?name='.urlencode($donatur->nama_donatur).'&background=4D7653&color=fff&size=80' }}"
                             alt="{{ $donatur->nama_donatur }}"
                             class="w-10 h-10 rounded-full object-cover flex-shrink-0 border-2 border-green-100">
                        <div class="min-w-0">
                            <span class="text-sm font-bold text-gray-800 block truncate">{{ $donatur->nama_donatur }}</span>
                            <span class="text-xs text-gray-500 block truncate">{{ $donatur->email }}</span>
                        </div>
                    </div>

                    {{-- KANAN: Tombol Aksi --}}
                    <div class="flex gap-1 items-center flex-shrink-0 ml-2">
                        <a href="{{ route('donatur.edit', $donatur->id_donatur) }}"
                           onclick="event.stopPropagation()"
                           class="text-blue-500 hover:text-blue-700 p-1.5 bg-blue-50 hover:bg-blue-100 rounded-md transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </a>
                        <form action="{{ route('donatur.destroy', $donatur->id_donatur) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data donatur ini?')"
                              onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 p-1.5 bg-red-50 hover:bg-red-100 rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-10 text-white/70 text-sm">
                    Belum ada data donatur.
                </div>
                @endforelse
            </div>

            <div class="flex justify-end mt-4">
                <a href="#" class="text-white/80 text-xs hover:text-white flex items-center gap-1">
                    Lainnya... <span class="text-lg leading-none">↗</span>
                </a>
            </div>
        </div>

    </div>
    {{-- AKHIR KOLOM KIRI --}}

    {{-- KOLOM KANAN: PANEL INFORMASI DONATUR --}}
    <div class="md:col-span-4">
        <div class="bg-[#4D7653] rounded-xl p-5 shadow-sm h-full relative min-h-[400px] flex flex-col">

            {{-- Header Panel --}}
            <div class="flex justify-between items-center text-white mb-6">
                <h3 class="text-sm font-medium">Informasi Donatur</h3>
                <button onclick="clearDetail()" class="text-white/70 hover:text-white transition p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Foto Donatur --}}
            <div class="flex justify-center mb-4">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white/20 flex-shrink-0">
                    <img id="detail-foto"
                         src="https://ui-avatars.com/api/?name=?&background=ffffff20&color=fff&size=112"
                         alt="Foto Donatur"
                         class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Info Teks --}}
            <div class="text-center text-white mb-4">
                <h2 id="detail-nama" class="text-lg font-bold mb-0.5">Pilih Donatur</h2>
                <p id="detail-email" class="text-xs text-white/70">Klik kartu untuk melihat detail</p>
            </div>

            {{-- Detail Rows --}}
            <div id="detail-rows" class="border-t border-white/15 pt-4 mt-auto hidden">
                <div class="flex justify-between py-2 border-b border-white/10 text-xs text-white">
                    <span class="opacity-70">No. HP</span>
                    <span id="detail-hp" class="font-medium">-</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/10 text-xs text-white">
                    <span class="opacity-70">Status</span>
                    <span id="detail-status" class="font-medium">-</span>
                </div>
                <div class="flex justify-between py-2 text-xs text-white">
                    <span class="opacity-70">Bergabung</span>
                    <span id="detail-bergabung" class="font-medium">-</span>
                </div>
            </div>

        </div>
    </div>
    {{-- AKHIR KOLOM KANAN --}}

</div>

{{-- JAVASCRIPT --}}
<script>
function toggleSearchPanel() {
    const panel = document.getElementById('searchPanel');
    panel.classList.toggle('hidden');
    if (!panel.classList.contains('hidden')) {
        document.getElementById('searchInput').focus();
    }
}

function filterDonatur() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.donatur-card');
    cards.forEach(card => {
        const match = card.dataset.nama.includes(keyword) ||
                      card.dataset.email.includes(keyword) ||
                      card.dataset.hp.includes(keyword) ||
                      card.dataset.status.includes(keyword);
        card.style.display = match ? 'flex' : 'none';
    });
}

function filterByStatus(status) {
    const cards = document.querySelectorAll('.donatur-card');
    cards.forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? 'flex' : 'none';
    });
    document.getElementById('searchInput').value = '';
}

function showDetail(nama, email, hp, status, bergabung, foto) {
    document.getElementById('detail-nama').textContent      = nama;
    document.getElementById('detail-email').textContent     = email;
    document.getElementById('detail-hp').textContent        = hp || '-';
    document.getElementById('detail-status').textContent    = status || '-';
    document.getElementById('detail-bergabung').textContent = bergabung || '-';
    document.getElementById('detail-foto').src              = foto;
    document.getElementById('detail-rows').classList.remove('hidden');
}

function clearDetail() {
    document.getElementById('detail-nama').textContent      = 'Pilih Donatur';
    document.getElementById('detail-email').textContent     = 'Klik kartu untuk melihat detail';
    document.getElementById('detail-hp').textContent        = '-';
    document.getElementById('detail-status').textContent    = '-';
    document.getElementById('detail-bergabung').textContent = '-';
    document.getElementById('detail-foto').src              = 'https://ui-avatars.com/api/?name=?&background=ffffff20&color=fff&size=112';
    document.getElementById('detail-rows').classList.add('hidden');
}

document.addEventListener('click', function(e) {
    const panel = document.getElementById('searchPanel');
    const searchBtn = e.target.closest('button[onclick*="toggleSearchPanel"]');
    if (!panel?.contains(e.target) && !searchBtn && !panel.classList.contains('hidden')) {
        panel.classList.add('hidden');
    }
});
</script>
@endsection