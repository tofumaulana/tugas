<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'code', 'description', 'kategori_id', 'penulis_id', 'cover_image'];

    protected static function booted()
    {
        static::creating(function ($book) {
            if (empty($book->code)) {
                $book->code = Str::slug($book->title);
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class);
    }

}
