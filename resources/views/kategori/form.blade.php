@csrf
<div class="mb-4">
    <label class="block">Nama Kategori</label>
    <input type="text" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}" class="border p-2 w-full" required>
    @error('nama') <div class="text-red-500">{{ $message }}</div> @enderror
</div>

<button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
    {{ $submit ?? 'Simpan' }}
</button>