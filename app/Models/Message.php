<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'message'];

    public function apartments()
    {
        return $this->belongsTo(Apartment::class);
    }
}