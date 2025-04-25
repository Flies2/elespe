@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl mb-4">Transaksi</h1>

        <form action="{{ route('transaksi.tambah') }}" method="POST" class="mb-4">
            @csrf
            <select name="item_id" class="border p-2">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} (Rp{{ number_format($item->harga) }})</option>
                @endforeach
            </select>
            <input type="number" name="jumlah" class="border p-2 w-24" placeholder="Jumlah" required>
            <button class="bg-blue-500 text-white px-4 py-2">Tambah</button>
        </form>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $c)
                    <tr>
                        <td>{{ $c['nama'] }}</td>
                        <td>Rp{{ number_format($c['harga']) }}</td>
                        <td>{{ $c['jumlah'] }}</td>
                        <td>Rp{{ number_format($c['harga'] * $c['jumlah']) }}</td>
                        <td>
                            <form action="{{ route('transaksi.hapus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $id }}">
                                <button class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-4 text-xl">Total: Rp{{ number_format($total) }}</h2>
        @if (count($cart) > 0)
            <form action="{{ route('transaksi.selesai') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    Bayar & Selesaikan Transaksi
                </button>
            </form>
        @endif

    </div>
@endsection
