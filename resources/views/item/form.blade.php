@csrf

<div class="mb-4">
    <label>Nama Item</label>
    <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="border p-2 w-full">
    @error('nama') <div class="text-red-500">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label>Kategori</label>
    <select name="kategori_id" class="border p-2 w-full">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}" {{ old('kategori_id', $item->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
            </option>
        @endforeach
    </select>
    @error('kategori_id') <div class="text-red-500">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label>Harga</label>
    <input type="number" name="harga" value="{{ old('harga', $item->harga ?? '') }}" class="border p-2 w-full">
    @error('harga') <div class="text-red-500">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label>Stok</label>
    <input type="number" name="stok" value="{{ old('stok', $item->stok ?? '') }}" class="border p-2 w-full">
    @error('stok') <div class="text-red-500">{{ $message }}</div> @enderror
</div>

<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">{{ $submit ?? 'Simpan' }}</button>
