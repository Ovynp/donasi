<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table= 'Berita';
    protected $fillable = ['judul','isi','slug'];

    
    public function getGaleris(){
        return asset('files/berita/thumbnail/'.$this->thumbnail);
    }
    public function Kegiatan(){
        return $this->hasOne(Kegiatan::class);
    }
    public function galeris(){
        return $this->hasMany(Galeri::class);
    }
}
