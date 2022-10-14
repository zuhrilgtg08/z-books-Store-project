<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Penerbit;
use App\Models\Category;
use App\Models\ReviewRating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category', 'penerbit', 'author'];

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ReviewData()
    {
        return $this->hasMany(ReviewRating::class, 'id_buku');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul_buku', 'like', '%' . $search . '%')
                ->orWhere('kode_buku', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['penerbit'] ?? false, function ($query, $penerbit) {
            return $query->whereHas('penerbit', function ($query) use ($penerbit) {
                $query->where('slug', $penerbit);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author) {
            return $query->whereHas('author', function($query) use ($author) {
                $query->where('slug', $author);
            });
        });
    }
}