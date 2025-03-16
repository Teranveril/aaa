<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category',
        'name',
        'photoUrls',
        'tags',
        'status',
    ];

    protected $casts = [
        'photoUrls' => 'array',
        'tags' => 'array',
    ];
}
