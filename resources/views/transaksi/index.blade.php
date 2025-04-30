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
            <input type="number" name="jumlah" class="border p-2 w-24" placeholder="Jumlah" min="1" required>
            <button class="bg-blue-500 text-white px-4 py-2">Tambah</button>
        </form>

        <table class="table-auto w-full">
            <thead class="bg-gray-300">
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Harga</th>
                    <th class="border px-4 py-2">Jumlah</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $c)
                    <tr>
                        <td class="border px-4 py-2">{{ $c['nama'] }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($c['harga']) }}</td>
                        <td class="border px-4 py-2">{{ $c['jumlah'] }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($c['harga'] * $c['jumlah']) }}</td>
                        <td class="border px-4 py-2">
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
            <form action="{{ route('transaksi.selesai') }}" method="POST" class="mt-4 space-y-4">
                @csrf

                <div>
                    <label for="bayar" class="block font-semibold">Uang Pembeli</label>
                    <input type="number" name="bayar" id="bayar" min="{{ $total }}"
                        class="border p-2 w-full md:w-64" required placeholder="Masukkan jumlah uang">
                </div>

                <button type="button" id="btn-hitung" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Hitung Kembalian
                </button>

                <div>
                    <label for="kembalian" class="block font-semibold">Kembalian</label>
                    <input type="text" id="kembalian" class="border p-2 w-full md:w-64 bg-gray-100" readonly>
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                    Bayar & Selesaikan Transaksi
                </button>
            </form>
        @endif


    </div>
    @if ($errors->has('jumlah'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Input Tidak Valid',
            text: '{{ $errors->first('jumlah') }}',
        });
    </script>
@endif

<script>
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const btnHitung = document.getElementById('btn-hitung');
    const total = {{ $total }};

    btnHitung.addEventListener('click', function () {
        const bayar = parseInt(bayarInput.value) || 0;
        const kembalian = bayar - total;


        if (kembalian >= 0) {
            kembalianInput.value = 'Rp ' + kembalian.toLocaleString('id-ID');
        } else {
            kembalianInput.value = 'Uang tidak cukup';
        }
    });
</script>
@endsection


