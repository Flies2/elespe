@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl mb-4">Struk Pembelian</h1>

    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->created_at }}</p>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Item</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->items as $item)
                <tr>
                    <td>{{ $item->item->nama }}</td>
                    <td>Rp{{ number_format($item->harga) }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp{{ number_format($item->harga * $item->jumlah) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-xl mt-4">Total: Rp{{ number_format($transaksi->total) }}</h2>
    <button onclick="window.print()" class="bg-gray-700 text-white px-4 py-2 rounded mt-3">
        Cetak Struk
    </button>

    <a href="{{ route('transaksi.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Transaksi Baru</a>
</div>
@endsection
