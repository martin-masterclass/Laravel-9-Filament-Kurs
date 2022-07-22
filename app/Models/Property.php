<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'password',
        'country',
        'address',
        'price',
        'sqm',
        'bedrooms',
        'bathroom',
        'garages',
        'slider'
    ];

}
