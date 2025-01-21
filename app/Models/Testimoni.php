<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'tbl_testimoni';
    protected $primaryKey = 'id_testimoni';

    protected $fillable = [
        'id_alumni',
        'testimoni',
        'tgl_testimoni'
    ];

    protected $casts = [
        'tgl_testimoni' => 'datetime'
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni', 'id_alumni');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}