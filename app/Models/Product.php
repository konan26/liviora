<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    public $incrementing = true;
    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'kategori_id',
        'gambar_url',
        'user_id',
    ];

    // Relasi
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }
}