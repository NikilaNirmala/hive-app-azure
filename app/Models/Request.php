<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /** @use HasFactory<\Database\Factories\RequestFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'message',
        'contact_email',
        'sender_id',
    ];



/////////////////////////////////////////////////////////////////////////////////
// ELEQUENT RELATIONSHIPS
////////////////////////////////////////////////////////////////////////////////

    public function sender()   { return $this->belongsTo(User::class, 'sender_id'); }
}
