<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'customer_id',
        'dvd_copy_id',
        'rental_price',
        'rented_at',
        'due_date',
        'returned_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function dvdCopy()
    {
        return $this->belongsTo(DvdCopy::class);
    }
}
