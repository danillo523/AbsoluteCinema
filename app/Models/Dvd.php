<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

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
}
