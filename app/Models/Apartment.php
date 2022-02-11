<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['title', 'slug', 'rooms', 'bathrooms', 'beds', 'squared_meters', 'address', 'longitude', 'latitiude', 'image', 'is_visible', 'floor', 'price', 'description'];

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }
}