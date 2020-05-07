<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'colour', 'time_found', 'place_found', 'description', 'image'];
}
