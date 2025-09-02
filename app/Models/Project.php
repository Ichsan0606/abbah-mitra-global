<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Tambahkan kolom yang boleh di-mass assign
    protected $fillable = [
        'project_name',
        'deskripsi',
        'foto',
        'id_kategori',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
