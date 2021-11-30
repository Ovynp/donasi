<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Panitia;
use App\Models\Berita;
use App\Models\Donatur;
use App\Models\Galeri;
use carbon\Carbon;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {   
        $sekarang = Carbon::now();
        if($request->has('cari')){
            $data_kegiatan= Kegiatan::where('nama','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_kegiatan = Kegiatan::all();       
        }
        return view('superAdmin.index',compact('data_kegiatan','sekarang'));
    }
    public function kegiatan()
    {
        
        return view('Home');
    }
    public function cetaklaporan(){
        $user = User::where('role','super admin')->first();
        // dd($user);
        $kegiatan =  Kegiatan::all();
        return view('SuperAdmin.laporan', compact('kegiatan','user'));
     }
     public function laporankegiatan(){
        $sekarang = Carbon::now();
        $user = User::where('role','super admin')->first();
        // dd($user);
        $kegiatans =  Kegiatan::all();
        return view('SuperAdmin.laporankegiatan', compact('kegiatans','user','sekarang'));
     }
     public function laporanview(Request $request, Kegiatan $kegiatan){
        // dd($request->all());
        $tgl_awal = $request->dari;
        $tgl_akhir = $request->sampai;
        $sekarang = Carbon::now();
        $user = User::where('id',$kegiatan->users_id)->first();
        $panitia = Panitia::where('kegiatan_id',$kegiatan->id)->first();
        $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status','2')->where('created_at','>=',$tgl_awal.' 00:00:00')->where('created_at','<=',$tgl_akhir.' 23:59:59')->get();
        $jumlah = Donatur::where('kegiatan_id',$kegiatan->id)->where('created_at','>=',$tgl_awal.' 00:00:00')->where('created_at','<=',$tgl_akhir.' 23:59:59')->where('status','2')->sum('jumlah_donasi');
        return view('SuperAdmin.laporanview', compact('kegiatan','donaturs','sekarang','user','panitia','jumlah','request'));
     }
     public function cari(Request $request){
        $sekarang = Carbon::now();
        if($request->has('cari')){
            $tampil= Kegiatan::where('nama','LIKE','%'.$request->cari.'%')->Where('batas_donasi','>=',$sekarang)->orderBy('batas_donasi','desc')->get();
        }else{
            $tampil = Kegiatan::all();       
        }
        // dd($data_kegiatan);
        return view('superAdmin.cari',compact('tampil'));
     }
     public function postingan(){
        $postingan = Berita::all();

        return view('superAdmin.postingan', compact('postingan'));
    }
    public function list(Kegiatan $kegiatan){
        $user = User::where('id',$kegiatan->users_id)->first();
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get();
        // dd($donatur);
        return view('superAdmin.list',compact('kegiatan','donatur','user'));
    }
    public function CariList(Request $request, Kegiatan $kegiatan){
        $kegiatan = Kegiatan::where('id',$kegiatan->id)->first();
        $user = User::where('id',$kegiatan->users_id)->first();
         // dd($kegiatan);
         $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
         $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
         $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
         if($request->has('cari')){
             $donatur= Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->where('nama','LIKE','%'.$request->cari.'%')->get();
            //  dd($donatur);
         }else{
             $donatur = Donatur::all();       
         }
         // dd($valid->all());
         return view('superAdmin.cariList',compact('donaturs','kegiatan','user','valid','validd','donatur'));
    }
    public function lihat(Berita $berita)
    {
        $kegiatan = Kegiatan::where('id',$berita->kegiatan_id)->first();
        $user = User::where('id',$kegiatan->users_id)->first();
        $galeris = Galeri::where('berita_id',$berita->id)->get();
        // dd($beritas);
        return view('superAdmin.lihatBerita',compact('berita', 'galeris','kegiatan','user'));
        }
    public function edituser()
    {   
   
        $user = User::where('role','super admin')->first();
        return view('superAdmin.edituser',compact('user'));
    }

}
