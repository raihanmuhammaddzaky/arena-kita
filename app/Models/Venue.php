<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'description',
        'price',
        'time_unit_minutes',
        'max_capacity',
        'is_active',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(VenueImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(VenueImage::class)->where('is_main', true);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
