@extends('layouts.app')
@section('title', 'Data Kamar')
@section('content')
<div class="flex flex-col w-full space-y-space-xl">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-space-md">
    <x-stat-card label="Total Kapasitas" :value="$roomSummary['total']" unit="Unit" icon="apartment" iconBg="bg-surface-container-low text-primary-container" subtitle="Data tersimpan" />
    <x-stat-card label="Kamar Terisi" :value="$roomSummary['occupied']" unit="Kamar" icon="group" iconBg="bg-primary-fixed/20 text-primary" subtitle="Dari database kamar" />
    <x-stat-card label="Siap Huni / Kosong" :value="$roomSummary['available']" unit="Unit" icon="meeting_room" iconBg="bg-secondary-fixed/40 text-secondary" subtitle="Status tersedia" />
    <x-stat-card label="Audit & Perbaikan" :value="$roomSummary['repair']" unit="Kamar" icon="construction" iconBg="bg-error-container/40 text-error" subtitle="Butuh perbaikan" />
  </div>

  <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
    <div>
      <h1 class="font-headline-lg text-on-surface font-bold">Data Kamar ({{ $roomSummary['total'] }} Unit)</h1>
      <p class="text-xs text-outline">Data kamar dan fasilitas dimuat dari backend KosAudit.</p>
    </div>
    <button onclick="document.getElementById('modal-tambah-kamar').classList.remove('hidden')" class="px-space-md h-10 rounded-lg bg-primary-container text-on-primary font-semibold text-sm flex items-center gap-1.5" type="button">
      <span class="material-symbols-outlined text-[20px]">add</span><span>Tambah Kamar Baru</span>
    </button>
  </div>

  <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm grid grid-cols-1 md:grid-cols-12 gap-space-sm">
    <div class="md:col-span-5"><input id="search-data-kamar" class="w-full h-10 px-3 rounded-lg bg-surface-container-low text-sm" placeholder="Cari nomor kamar, tipe, atau penghuni..." type="text"/></div>
    <div class="md:col-span-2">
      <select id="filter-lantai" class="w-full h-10 px-3 rounded-lg bg-surface-container-low text-sm">
        <option value="">Semua Lantai</option><option value="1">Lantai 1</option><option value="2">Lantai 2</option><option value="3">Lantai 3</option>
      </select>
    </div>
    <div class="md:col-span-2">
      <select id="filter-tipe" class="w-full h-10 px-3 rounded-lg bg-surface-container-low text-sm">
        <option value="">Semua Tipe</option><option value="standar">Standar</option><option value="ac">AC</option><option value="deluxe">Deluxe</option>
      </select>
    </div>
    <div class="md:col-span-3">
      <select id="filter-status" class="w-full h-10 px-3 rounded-lg bg-surface-container-low text-sm">
        <option value="">Status (Semua)</option><option value="terisi">Terisi</option><option value="kosong">Kosong</option><option value="perbaikan">Perbaikan</option>
      </select>
    </div>
  </div>

  <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table id="rooms-table" class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-surface-container-low text-outline text-xs uppercase tracking-wider">
            <th class="py-3.5 px-space-lg">No. Kamar</th>
            <th class="py-3.5 px-space-md">Tipe Kamar</th>
            <th class="py-3.5 px-space-md">Harga Sewa</th>
            <th class="py-3.5 px-space-md">Fasilitas</th>
            <th class="py-3.5 px-space-md">Penghuni Saat Ini</th>
            <th class="py-3.5 px-space-md text-center">Status Kamar</th>
            <th class="py-3.5 px-space-lg text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-surface-container-low text-sm">
          @foreach ($rooms as $k)
          <tr class="hover:bg-surface-container-low/60">
            <td class="py-3.5 px-space-lg">
              <a href="{{ route('kamar.show', $k[0]) }}" class="font-bold text-primary hover:underline block">Kamar {{ $k[0] }}</a>
              <span class="text-xs text-outline">Lantai {{ $k[1] }} • {{ $k[2] }}</span>
            </td>
            <td class="py-3.5 px-space-md"><span class="font-semibold block">Tipe {{ $k[3] }}</span><span class="text-xs text-outline">{{ $k[4] }}</span></td>
            <td class="py-3.5 px-space-md font-semibold">{{ $k[5] }} <span class="text-xs text-outline font-normal">/ bln</span></td>
            <td class="py-3.5 px-space-md text-xs text-on-surface-variant">{{ $k[6] }}</td>
            <td class="py-3.5 px-space-md"><span class="font-semibold block">{{ $k[7] }}</span><span class="text-xs text-outline">{{ $k[8] }}</span></td>
            <td class="py-3.5 px-space-md text-center"><x-badge :status="$k[9]" /></td>
            <td class="py-3.5 px-space-lg text-right">
              <a href="{{ route('kamar.show', $k[0]) }}" class="px-2.5 py-1 rounded bg-surface-container-low hover:bg-surface-container text-xs font-semibold text-primary">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="pagination-data-kamar" class="py-3.5 px-space-lg bg-surface-container-lowest"></div>
  </div>
</div>

<x-modal id="modal-tambah-kamar" title="Tambah Data Kamar Baru">
  <form method="POST" action="{{ route('kamar.store') }}" class="space-y-3">
    @csrf
    <div class="grid grid-cols-2 gap-3">
      <div><label class="text-xs font-semibold block mb-1">Nomor Kamar *</label><input type="text" name="room_number" required maxlength="10" placeholder="109" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/></div>
      <div><label class="text-xs font-semibold block mb-1">Deskripsi</label><input type="text" name="description" maxlength="1000" placeholder="Lantai 1, sayap timur" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/></div>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div><label class="text-xs font-semibold block mb-1">Tipe *</label><select name="type" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"><option value="Standar">Standar</option><option value="AC">AC</option><option value="AC + KM Dalam">AC + KM Dalam</option></select></div>
      <div><label class="text-xs font-semibold block mb-1">Harga Sewa (Rp) *</label><input type="number" name="monthly_price" value="1500000" required min="0" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/></div>
    </div>
    <div>
      <label class="text-xs font-semibold block mb-2">Item kondisi kamar</label>
      <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto rounded-lg bg-surface-container-low p-3">
        @foreach ($masterItems as $index => $item)
          <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="items[{{ $index }}][master_item_id]" value="{{ $item->id }}">
            <span>{{ $item->name }}</span>
            <input type="number" name="items[{{ $index }}][quantity]" value="1" min="1" max="255" disabled class="w-14 rounded bg-white px-1 py-0.5" aria-label="Jumlah {{ $item->name }}">
          </label>
        @endforeach
      </div>
    </div>
    <div class="flex justify-end gap-2 pt-2">
      <button type="button" onclick="document.getElementById('modal-tambah-kamar').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-surface-container text-xs">Batal</button>
      <button type="submit" class="px-4 py-2 rounded-lg bg-primary-container text-on-primary text-xs font-semibold">Simpan Kamar</button>
    </div>
  </form>
</x-modal>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const rt = new TablePlus('#rooms-table', { perPage: 7, perPageOptions: [7, 10, 24], searchInput: '#search-data-kamar', paginationContainer: '#pagination-data-kamar' });
  document.querySelectorAll('input[name*="master_item_id"]').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.closest('label').querySelector('input[type="number"]').disabled = !checkbox.checked;
    });
  });
  document.getElementById('global-header-search')?.addEventListener('input', e => rt.search(e.target.value));
  document.getElementById('filter-lantai')?.addEventListener('change', e => rt.setFilter('lt', !e.target.value ? null : r => r.children[0].innerText.includes('Lantai ' + e.target.value)));
  document.getElementById('filter-tipe')?.addEventListener('change', e => rt.setFilter('tp', !e.target.value ? null : r => r.children[1].innerText.toLowerCase().includes(e.target.value)));
  document.getElementById('filter-status')?.addEventListener('change', e => {
    const value = e.target.value;
    rt.setFilter('st', !value ? null : row => row.children[5].innerText.toLowerCase().includes(value === 'perbaikan' ? 'perbaikan' : value));
  });
});
</script>
@endpush