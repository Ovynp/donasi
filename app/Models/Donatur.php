<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table= 'Donatur';

    public function getBukti(){
        return asset('files/bukti/'.$this->file_bukti);
    }
    public function kegiatan(){
        return $this->belongsTo(Kegiatan::class);
    }
    public function mediaTransfer(){
        return $this->belongsTo(mediaTransfer::class);
    }
}
