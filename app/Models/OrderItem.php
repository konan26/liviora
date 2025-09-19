<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_item_id';
    public $incrementing = true;
    protected $table = 'order_items';

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_id',
        'jumlah',
        'harga_satuan',
    ];

    // Relasi
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}