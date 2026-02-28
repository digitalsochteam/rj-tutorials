<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'is_read'];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
