<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kategori_id', 'harga', 'stok'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
