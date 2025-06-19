<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    use HasFactory;
    protected $table = 'countdowns';
    protected $fillable = ['countdown_date', 'is_active'];
    protected $casts = [
        'countdown_date' => 'datetime',
        'is_active' => 'boolean',
    ];
}
