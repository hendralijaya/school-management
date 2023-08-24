<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = [
        'total_tagihan',
        'deadline_tagihan',
        'tanggal_lunas',
        'dokumen_invoice',
        'siswa_id',
        'biaya_sekolah_id',
        'diskon_id',
    ];
    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function biayaSekolah()
    {
        return $this->belongsTo(BiayaSekolah::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }
    use HasFactory;
}
