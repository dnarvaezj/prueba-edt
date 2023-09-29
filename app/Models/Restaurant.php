<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'name',
        'site',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'lat',
        'lng'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
