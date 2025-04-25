<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $fillable = ['transaksi_id', 'item_id', 'jumlah', 'harga'];

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class);
    }
}
