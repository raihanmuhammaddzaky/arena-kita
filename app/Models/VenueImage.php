<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'image_path',
        'is_main',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function getImageUrlAttribute()
    {
        if (\Illuminate\Support\Str::startsWith($this->image_path, ['http://', 'https://'])) {
            return $this->image_path;
        }
        return asset('storage/' . $this->image_path);
    }
}
