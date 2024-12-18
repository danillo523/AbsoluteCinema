<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvdCopy extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'dvd_id',
        'available',
    ];

    public function dvd()
    {
        return $this->belongsTo(Dvd::class);
    }
}
