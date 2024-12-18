<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'genre_id',
        'rental_price',
        'available_copies',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function dvdCopies()
    {
        return $this->hasMany(DvdCopy::class);
    }

    public function getAvailableCopiesAttribute()
    {
        return $this->dvdCopies()->where('available', true)->count();
    }
}
