<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $table = 'Panitia';
    public $timestamps = false;
    protected $fillable = ['nama','alamat','no_telp','kegiatan_id'];

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class);
    }
}
