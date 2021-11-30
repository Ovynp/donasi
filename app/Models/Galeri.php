<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table= 'Galeri';
    protected $fillable = ['foto','berita_id'];
    
    public function getFoto(){
        return asset('files/berita/'.$this->foto);
    }
    // public function getGaleris(){
    //     return asset('files/berita/'.$this->foto);
    // }
}
