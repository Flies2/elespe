<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index () 
    {
        $totalKategori = Kategori::count();
        $totalItem = Item::count();
        $jumlahTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total');

        $transaksiTerakhir = Transaksi::latest()->take(5)->get();

        return view('dashboard', compact('totalKategori', 'totalItem', 'jumlahTransaksi', 'totalPendapatan', 'transaksiTerakhir'));
    }
}
