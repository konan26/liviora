<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'kategori_id';
    public $incrementing = true;
    protected $table = 'categories';

    protected $fillable = [
        'kategori_id',
        'nama_kategori',
    ];

    // Relasi
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'kategori_id');
    }
}