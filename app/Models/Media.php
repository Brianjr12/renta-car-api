<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'file_url',
        'type',
    ];

    /**
     * Relationships.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
