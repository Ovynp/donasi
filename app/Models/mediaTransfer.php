<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mediaTransfer extends Model
{
    protected $table = 'media_transfer';
    public $timestamps = false;
    protected $fillable = ['nomor','nama_media','nama_pemilik','kegiatan_id'];

    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class);
    }
    public function donaturs(){
        return $this->hasMany(Donatur::class);
    }
    
}
