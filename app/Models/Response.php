<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected $primaryKey = 'response_id';
    public $incrementing = true;
    protected $table = 'responses';

    protected $fillable = [
        'response_id',
        'report_id',
        'user_id',
        'isi_tanggapan',
        'tanggal_reply',
    ];

    // Relasi
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}