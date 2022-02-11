<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //
        public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
