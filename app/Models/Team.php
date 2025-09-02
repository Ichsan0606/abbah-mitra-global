<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'full_name',
        'job',
        'deskripsi',
        'foto',
    ];
}
