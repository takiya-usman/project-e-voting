<?php

namespace App\Models;

use App\Models\User;
use App\Models\kandidat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suara extends Model
{
    use HasFactory;
    protected $table = 'suara';
    protected $fillable = ['id_kandidat', 'id_users', 'waktu_pemilihan'];


    public function kandidat()
    {
        return $this->belongsTo(kandidat::class, 'id_kandidat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
