<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $primaryKey = 'report_id';
    public $incrementing = true;
    protected $table = 'reports';

    protected $fillable = [
        'report_id',
        'user_id',
        'isi_laporan',
        'status',
        'tanggal_lapor',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'report_id', 'report_id');
    }
}