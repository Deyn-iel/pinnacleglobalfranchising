<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'cost_price',
        'selling_price',
        'stock',
        'image',
    ];
}
