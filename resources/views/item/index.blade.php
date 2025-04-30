@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Master Item</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('item.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Item</a>

    <table class="table-auto w-full mt-4">
        <thead class="bg-gray-300">
            <tr>
                <th class="border px-4 py-2">Nomer</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Harga</th>
                <th class="border px-4 py-2">Stok</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->kategori->nama }}</td>
                    <td class="border px-4 py-2">{{ number_format($item->harga) }}</td>
                    <td class="border px-4 py-2">{{ $item->stok }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('item.edit', $item) }}" class="text-blue-600">Edit</a>
                        <form id="form-hapus-{{ $item->id }}" action="{{ route('item.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-600 ml-2 btn-hapus" data-id="{{ $item->id }}">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    <script>
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Yakin mau dihapus?',
                    text: "Item akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-hapus-' + id).submit();
                    }
                })
            });
        });
    </script>
    
@endif

@endsection
