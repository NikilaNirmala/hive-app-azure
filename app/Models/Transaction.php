<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'type',
        'user_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

/////////////////////////////////////////////////////////////////////////////////
// ELEQUENT RELATIONSHIPS
////////////////////////////////////////////////////////////////////////////////


public function user() { return $this->belongsTo(User::class); }
}
