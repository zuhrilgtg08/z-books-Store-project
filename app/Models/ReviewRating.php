<?php

namespace App\Models;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['buku', 'user'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
