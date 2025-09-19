<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $table = 'users';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'password_hash',
        'no_hp',
        'role',
        'status',
        'tanggal_daftar',
    ];

    protected $hidden = ['password_hash'];

    // Mengganti kolom default untuk autentikasi
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relasi
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id', 'user_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}