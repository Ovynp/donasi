<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $dates = ['batas_donasi', 'created_at', 'updated_at'];
    protected $table = 'Kegiatan';
    protected $fillable = ['nama','alamat','no_hp','target_donasi','file_pendukung','batas_donasi','users_id'];

   

    public function gettFoto(){
        if(!$this->foto){
            return asset('images/default1.png');
            }
        return asset('images/kegiatan/'.$this->foto);
    }
    public function getFoto(){
            return asset('images/default.png');
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function donaturs(){
        return $this->hasMany(Donatur::class);
    }
    public function mediaTransfers(){
        return $this->hasMany(mediaTransfer::class);
    }
    public function panitias(){
        return $this->hasMany(Panitia::class);
    }
    public function beritas(){
        return $this->hasMany(Berita::class);
    }
    public function totalDonasi(){
        $total=0;
        foreach($this->donaturs as $donatur){
            if($donatur->status==2){

                $total = $total + $donatur->jumlah_donasi;
            }
        }
        return $total;
    }
    public function getFile(){
       
        return asset('pendukung/'.$this->file_pendukung);
    }
}
