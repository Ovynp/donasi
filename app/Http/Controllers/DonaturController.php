<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mediaTransfer;
use App\Models\Kegiatan;
use App\Models\Donatur;
use App\Models\Berita;
use App\Models\Panitia;
use App\Models\User;
use Illuminate\Support\Str;
use carbon\Carbon;


class DonaturController extends Controller
{
    public function index(Request $request, Kegiatan $kegiatan)
    {
            // $panitia = Panitia::where('kegiatan_id',$kegiatan->id)->get();
            $sekarang = Carbon::now();
            $batas_donasi = $kegiatan->batas_donasi;
            $tampil = Kegiatan::Where('batas_donasi','>=',$sekarang)->orderBy('batas_donasi','desc')->get();
        return view('donatur.index',compact('tampil','sekarang'));
    }
    public function bukti(Kegiatan $kegiatan)
    {
        $media = mediaTransfer::where('kegiatan_id',$kegiatan->id)->where('nama_media','!=','Donasi Langsung')->get();
        return view('donatur.create',compact('kegiatan','media'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'nama' => 'required',
            'jumlah_donasi' => 'required',
            'no_hp' => 'required|min:14|max:15',
            'file_bukti' => 'required|mimes:jpg,png,docx,pdf'
        ]);
        $donatur = new Donatur;
        $donatur->kegiatan_id = $request->kegiatan_id;
        $donatur->status = $request->status;
        $donatur->media_transfer_id = $request->mediaTransfer;
        $donatur->nama = $request->nama;
        $donatur->jumlah_donasi = currencyIDRToNumeric($request->jumlah_donasi);
        $donatur->file_bukti = $request->file_bukti;
        $donatur->no_hp = $request->no_hp;
        if($request->hasFile('file_bukti')){
            $request->file('file_bukti')->move('files/bukti',$request->file('file_bukti')->getClientOriginalName());
            $donatur->file_bukti=$request->file('file_bukti')->getClientOriginalName();
            $donatur->save(); 
        }
        return redirect('/')->with('sukses','Upload bukti berhasil, tunggu SMS notifikasi dari admin');
    }
    public function list(Kegiatan $kegiatan, User $user)
    {
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get();
        // dd($donatur);
        return view('donatur.list',compact('kegiatan','donatur','user'));
    }
    public function cari(Request $request)
    {   
        $sekarang = Carbon::now();
        if($request->has('cari')){
            $tampil= Kegiatan::where('nama','LIKE','%'.$request->cari.'%')->Where('batas_donasi','>=',$sekarang)->orderBy('batas_donasi','desc')->get();
        }else{
            $tampil = Kegiatan::all();       
        }
        // dd($data_kegiatan);
        return view('donatur.cari',compact('tampil','sekarang'));
    }
    
    public function postingan(){
        $postingan = Berita::all();

        return view('donatur.postingan', compact('postingan'));
    }
    public function cariDonatur(Request $request, Kegiatan $kegiatan){
        $kegiatan = Kegiatan::where('id',$kegiatan->id)->first();
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
         return view('donatur.cariDonatur',compact('donaturs','kegiatan','valid','validd','donatur'));
    }
    public function file(Kegiatan $kegiatan){
        return response()->download('files/'.$kegiatan->file_pendukung);
    }
}
