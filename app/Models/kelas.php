<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
