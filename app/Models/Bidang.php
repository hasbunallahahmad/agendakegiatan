<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
}
