<?php

namespace App\Models;

// use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid as Traits;
use App\Models\Keranjang;
use App\Models\Province;
use App\Models\Cities;
use App\Models\User;
class Order extends Model
{
    use HasFactory, Traits;
    protected $guarded = ['id'];
    protected $table = 'orders';
    protected $with = ['province', 'cities'];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function cities()
    {
        return $this->belongsTo(Cities::class, 'destination_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
