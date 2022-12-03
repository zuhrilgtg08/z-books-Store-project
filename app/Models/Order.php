<?php

namespace App\Models;

// use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid as Traits;
use App\Models\Keranjang;
use App\Models\User;
class Order extends Model
{
    use HasFactory, Traits;
    protected $guarded = ['id'];
    protected $with = ['keranjang'];
    protected $table = 'orders';

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }
}
