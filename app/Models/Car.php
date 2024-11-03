<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model',
        'brand_id',
        'year',
        'price_per_day',
        'color',
        'description',
        'availability',
        'popularity',
    ];

    /**
     * Relationships.
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
