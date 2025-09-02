<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
       
    // Tambahkan kolom yang boleh di-mass assign
    protected $fillable = [
        'client_name',
        'deskripsi',
        'foto',
    ];
}
