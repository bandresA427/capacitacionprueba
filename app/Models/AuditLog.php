<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class AuditLog extends Model
{
    protected $fillable = [
        'user_id', // Add this line
        'type',
        'component',
        'action',
        'url',
    ];
}
