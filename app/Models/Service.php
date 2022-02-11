<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    protected $fillable = ['slug', 'name'];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}