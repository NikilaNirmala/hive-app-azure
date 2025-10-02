<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'reviews';

    protected $fillable = ['title', 'rating', 'comment', 'user_id'];

    protected $casts = [
        'rating'         => 'decimal:2',
    ];
}
