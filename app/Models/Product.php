<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //added code
    //protected $table = 'my_products';
    protected $fillable=[
        'name',
        'slug',
        'description',
        'price'
    ];
    //added code
}
