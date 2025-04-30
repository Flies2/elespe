<?php

namespace App\Http\Controllers;

use id;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiItem;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $c) {
            $total += $c['jumlah'] * $c['harga'];
        }

        return view('transaksi.index', compact('items', 'cart', 'total'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1'
        ], [
            'jumlah.min' => 'Jumlah item tidak boleh kurang dari 1.'
        ]);
        $item = Item::findOrFail($request->item_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]['jumlah'] += $request->jumlah;
        } else {
            $cart[$item->id] = [
                'nama' => $item->nama,
                'harga' => $item->harga,
                'jumlah' => $request->jumlah
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('transaksi.index');
    }

    public function hapus(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->item_id]);
        session(['cart' => $cart]);

        return redirect()->route('transaksi.index')->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    public function selesai(Request $request)
{
    $cart = session('cart', []);
    if (count($cart) == 0) {
        return redirect()->route('transaksi.index')->with('error', 'Keranjang kosong!');
    }

    $total = 0;
    foreach ($cart as $c) {
        $total += $c['jumlah'] * $c['harga'];
    }

    $request->validate([
        'bayar' => "required|numeric|min:$total"
    ]);

    $bayar = $request->bayar;

    // Simpan transaksi
    $transaksi = Transaksi::create([
        'total' => $total,
        'pay_total' => $bayar,
        'user_id' => auth()->id()
    ]);

    // Simpan detail item
    foreach ($cart as $id => $c) {
        TransaksiItem::create([
            'transaksi_id' => $transaksi->id,
            'item_id' => $id,
            'jumlah' => $c['jumlah'],
            'harga' => $c['harga'],
        ]);

        // Kurangi stok
        $item = Item::find($id);
        $item->stok -= $c['jumlah'];
        $item->save();
    }

    session()->forget('cart');

    return redirect()->route('transaksi.struk', $transaksi->id);
}

    public function struk($id)
    {
        $transaksi = Transaksi::with('items.item')->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }

    public function riwayat()
    {
        $riwayat = \App\Models\Transaksi::latest()->get();
        return view('transaksi.riwayat', compact('riwayat'));
    }
}
