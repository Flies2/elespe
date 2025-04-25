@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Riwayat Transaksi</h1>

    @if($riwayat->isEmpty())
        <p>Belum ada transaksi.</p>
    @else
        <table class="table-auto w-full">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-2">Nomer</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $trx)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $trx->created_at->format('d M Y H:i') }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($trx->total) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('transaksi.struk', $trx->id) }}" class="text-blue-600">Lihat Struk</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
