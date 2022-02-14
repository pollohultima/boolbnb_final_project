<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable = ['title', 'slug', 'rooms', 'bathrooms', 'beds', 'squared_meters', 'address', 'longitude', 'latitiude', 'image', 'is_visible', 'floor', 'price', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(Views::class);
    }
}