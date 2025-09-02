<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'kategori_name',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'id_kategori');
    }
}
