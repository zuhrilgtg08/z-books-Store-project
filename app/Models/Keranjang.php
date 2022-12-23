<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $with = ['user', 'buku', 'order'];
    protected $table = 'keranjangs';

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
