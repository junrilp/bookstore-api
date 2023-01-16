<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'title',
        'sub_title',
        'author',
        'price',
    ];

}
