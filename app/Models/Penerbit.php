<?php

namespace App\Models;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Penerbit extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
