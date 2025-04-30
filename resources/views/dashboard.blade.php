@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-gray-500 mb-2">Total Kategori</div>
                <div class="text-4xl font-bold text-blue-600">{{ $totalKategori }}</div>
            </div>
        
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-gray-500 mb-2">Total Item</div>
                <div class="text-4xl font-bold text-green-600">{{ $totalItem }}</div>
            </div>
        
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-gray-500 mb-2">Jumlah Transaksi</div>
                <div class="text-4xl font-bold text-yellow-600">{{ $jumlahTransaksi }}</div>
            </div>
        
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-gray-500 mb-2">Total Pendapatan</div>
                <div class="text-4xl font-bold text-red-600">Rp{{ number_format($totalPendapatan) }}</div>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2">Transaksi Terbaru</h2>
            <table class="table-auto w-full bg-white rounded shadow overflow-hidden">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="border px-4 py-2">Nomer</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerakhir as $trx)
                        <tr class="border-t">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $trx->created_at->format('d M Y H:i') }}</td>
                            <td class="border px-4 py-2">Rp{{ number_format($trx->total) }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('transaksi.struk', $trx->id) }}" class="text-blue-600 hover:underline">Lihat Struk</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
@endsection
