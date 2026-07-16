<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'proof_image',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function getProofImageUrlAttribute()
    {
        if (\Illuminate\Support\Str::startsWith($this->proof_image, ['http://', 'https://'])) {
            return $this->proof_image;
        }
        return asset('storage/' . $this->proof_image);
    }
}
