<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['total', 'pay_total', 'user_id'];

    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }
}
