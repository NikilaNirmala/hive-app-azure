<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /** @use HasFactory<\Database\Factories\AdvertisementFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'country',
        'description',
        'no_rooms',
        'property_size',
        'price',
        'property_type',
        'admin_id',
        'user_id',
        'image_path'
    ];

    protected $casts = [
        'no_rooms'      => 'integer',
        'property_size' => 'integer',
        'price'         => 'decimal:2',
    ];


/////////////////////////////////////////////////////////////////////////////////
// ELEQUENT RELATIONSHIPS
////////////////////////////////////////////////////////////////////////////////

public function user()       { return $this->belongsTo(User::class); }

}
