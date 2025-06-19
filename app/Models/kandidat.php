<?php

namespace App\Models;

use App\Models\Suara;
use App\Models\visimisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kandidat extends Model
{
    use HasFactory;
    protected $table = "kandidat";
    protected $fillable = ['nama_kandidat', 'nama_calon', 'foto'];

    public function visimisi()
    {
        return $this->hasMany(visimisi::class);
    }
    public function suara()
    {
        return $this->hasMany(Suara::class, 'id_kandidat', 'id');
    }
}
