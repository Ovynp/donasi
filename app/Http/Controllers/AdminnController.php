<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Panitia;
use App\Models\MediaTransfer;
use carbon\Carbon;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Http\Request;

class AdminnController extends Controller
{
    public function index(User $user)
    {
        $sekarang = Carbon::now(); 
        // $user = User::all();
        $kegiatan = Kegiatan::where('users_id',$user->id)->first();
        // dd($kegiatan);
        $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        // dd($valid->all());
        return view('adminn.index',compact('donaturs','kegiatan','user','valid','validd','sekarang'));
    }
    public function detail(User $user, Kegiatan $kegiatan, $donatur)
    {   
        // dd($user);
        // $kegiatan = Kegiatan::where('users_id',$user)->first();
        $donatur = Donatur::where('id',$donatur)->first();
        $media = mediaTransfer::where('kegiatan_id',$kegiatan->id)->get();
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        // dd($donatur);
        return view('adminn.detail', compact('donatur','user','kegiatan','valid','validd','media'));
    }
    public function update(Request $request, $user, $kegiatan , $donatur)
    {
        // dd($request->all());
        $this->validate($request,[
            'nama' => 'required',
            'jumlah_donasi' => 'required',
            'no_hp' => 'required'
        ]);
        $donaturs = Donatur::all()->where('id',$donatur)->first();
        // dd($donaturs->all());
        $donaturs->nama = $request->nama;
        $donaturs->jumlah_donasi =currencyIDRToNumeric($request->jumlah_donasi);
        $donaturs->no_hp = $request->no_hp;
        $donaturs->media_transfer_id = $request->mediaTransfer;
        $donaturs->save();
        return redirect()->back()->with('sukses','Data berhasil diupdate');
    }
        // dd($donatur->all());
    public function more(User $user)
    {
        // $user = User::all();
        $kegiatan = Kegiatan::where('users_id',$user->id)->first();
        $media = mediaTransfer::where('kegiatan_id',$kegiatan->id)->get();
        $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get();
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        // dd($data->all());
        // dd($valid);
        return view('adminn.more',compact('donaturs','kegiatan','user','valid','validd','media'));
    }
    public function updateStatus(Request $request, $kegiatan, $donatur)
    {
        // dd($request->all());
        $kegiatans = Kegiatan::where('id',$kegiatan)->first();
        $donaturs = Donatur::where('id',$donatur)->first();
        // dd(currency_IDR($donaturs->jumlah_donasi));
        // dd($donaturs->status);
        $donaturs->status = '2';
        $donaturs->save();
        //SMS LARAVEL
        Nexmo::message()->send([
            'to'   => $request->no_hp,
            'from' => '0000',
            'text' => 'Terimakasih '.$donaturs->nama.' sudah berdonasi sebanyak '.currency_IDR($donaturs->jumlah_donasi).' pada '.$kegiatans->nama.'.',
        ]);

        // return redirect(to.'/')->with('success','SMS Send Successfully');

        return redirect()->back()->with('sukses','Donatur divalidasi');
        // return view('admink.more',compact('donaturs','kegiatan'));
    }
    public function delete($kegiatan, $donatur)
    {
        $donaturs = Donatur::where('id',$donatur)->first();    
        // dd($donaturs);
        $donaturs->delete($donatur);
        return redirect()->back()->with('sukses', 'Donatur telah dihapus');
    }
    public function profil(User $user, Kegiatan $kegiatan)
    {
        $kegiatan = Kegiatan::where('users_id',$user->id)->first();
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        $md = MediaTransfer::where('kegiatan_id',$kegiatan->id)->where('nama_media','!=','Donasi Langsung')->get();
        $sekarang = Carbon::now();
        return view('adminn.profil', compact('valid','validd','user','kegiatan','donatur','sekarang','md'));
    }
    public function edit(User $user, Kegiatan $kegiatan)
    {   
    //    dd($kegiatan);
        $mediaTransfer = mediaTransfer::where('kegiatan_id', $kegiatan->id)->get();
        // dd($mediaTransfer);
        $panitia = Panitia::where('kegiatan_id', $kegiatan->id)->get();
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        return view('superAdmin.edit',compact('kegiatan','mediaTransfer','panitia','user','valid','validd'));
    }
    public function updated(Request $request, User $user, Kegiatan $kegiatan)
    {  
        // dd($request->kebutuhan_biaya);
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'target_donasi' => 'required',
            'file_pendukung' => 'mimes:pdf,docx,jpg,png',
            'batas_donasi' => 'required',
            'foto' => 'mimes:jpg,png'

        ]);
        $kegiatan->nama = $request->nama;
        $kegiatan->alamat = $request->alamat;
        $kegiatan->no_hp = $request->no_hp;
        $kegiatan->target_donasi = currencyIDRToNumeric($request->target_donasi);
        if($request->hasFile('file_pendukung')){
            $request->file('file_pendukung')->move('pendukung',$request->file('file_pendukung')->getClientOriginalName());
            $kegiatan->file_pendukung=$request->file('file_pendukung')->getClientOriginalName();
        }
        $kegiatan->batas_donasi = $request->batas_donasi;
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/kegiatan',$request->file('foto')->getClientOriginalName());
            $kegiatan->foto=$request->file('foto')->getClientOriginalName();
            $kegiatan->save();
        }
        $kegiatan->save();
        if ($user->role == 'super admin') 
        {
            return redirect('admin/'.$user->id.'/'.$kegiatan->id.'/profil')->with('sukses','Data berhasil diupdate');
        }
        if ($user->role == 'admin') 
        {
            return redirect('admin/'.$user->id.'/'.$kegiatan->id.'/dashboard')->with('sukses','Data berhasil diupdate');
        }
    }
    public function laporan(Request $request, User $user, Kegiatan $kegiatan){
        $sekarang = Carbon::now();
        $user = User::where('id',$kegiatan->users_id)->first();
        $panitia = Panitia::where('kegiatan_id',$kegiatan->id)->first();
        $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('created_at','>=',$request->dari.' 00:00:00')->where('created_at','<=',$request->sampai.' 23:59:59')->where('status','2')->get();
        $jumlah = Donatur::where('kegiatan_id',$kegiatan->id)->where('created_at','>=',$request->dari.' 00:00:00')->where('created_at','<=',$request->sampai.' 23:59:59')->sum('jumlah_donasi');
        return view('SuperAdmin.laporanview', compact('kegiatan','donaturs','sekarang','user','panitia','jumlah','request'));
    }
    public function createDonatur(User $user, Kegiatan $kegiatan){
        // dd($user);
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        $md = MediaTransfer::where('kegiatan_id',$kegiatan->id)->where('nama_media','Donasi Langsung')->first();

        return view('adminn.createDonatur',compact('kegiatan','user','valid','validd','md'));
    }
    public function store(Request $request, User $user, Kegiatan $kegiatan){
        // dd($request->all());
        $this->validate($request,[
            'nama' => 'required',
            'jumlah_donasi' => 'required',
            'file_bukti' => 'required|mimes:jpg,png',
            'no_hp' => 'required|min:14|max:15'
        ]);

        $donatur = new Donatur;
        $donatur->kegiatan_id = $request->kegiatan_id;
        $donatur->status = $request->status;
        $donatur->nama = $request->nama;
        $donatur->jumlah_donasi = currencyIDRToNumeric($request->jumlah_donasi);
        $donatur->file_bukti = $request->file_bukti;
        $donatur->no_hp = $request->no_hp;
        if($request->hasFile('file_bukti')){
            $request->file('file_bukti')->move('files/bukti',$request->file('file_bukti')->getClientOriginalName());
            $donatur->file_bukti=$request->file('file_bukti')->getClientOriginalName();
            $donatur->save(); 
        }
        Nexmo::message()->send([
            'to'   => $donatur->no_hp,
            'from' => '0000',
            'text' => 'Terimakasih '.$donatur->nama.' sudah berdonasi sebanyak '.currency_IDR($donatur->jumlah_donasi).' pada '.$kegiatan->nama.'.',
        ]);
        return redirect('admin/'.$user->id.'/'.$kegiatan->id)->with('sukses','Donatur Berhasil Ditambahkan');
    }
    public function cari(Request $request, User $user){
        //  dd($request->all());
         $kegiatan = Kegiatan::where('users_id',$user->id)->first();
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
         return view('adminn.cari',compact('donaturs','kegiatan','user','valid','validd','donatur'));
    }
    public function carimore(Request $request, User $user){
        //  dd($request->all());
         $kegiatan = Kegiatan::where('users_id',$user->id)->first();
         // dd($kegiatan);
         $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
         $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        //  dd($valid);
         $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
         if($request->has('cari')){
             $donatur= Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->where('nama','LIKE','%'.$request->cari.'%')->get();
            //  dd($donatur);
         }else{
             $donatur = Donatur::all();       
         }
         // dd($valid->all());
         return view('adminn.carimore',compact('donaturs','kegiatan','user','valid','validd','donatur'));
    }
    public function edituser(User $user, Kegiatan $kegiatan)
    {   
    //    dd($user);
    $kegiatan = Kegiatan::where('users_id',$user->id)->first();
    // dd($kegiatan);
    $donaturs = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get(); //status 2 untuk donatur yang sudah tervalidasi
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        //  dd($valid);
         $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        $user = User::where('id',$user->id)->first();
        return view('adminn.edituser',compact('user','validd','valid','kegiatan','donaturs'));
    }
    // public function editt(User $user, Kegiatan $kegiatan)
    // {   
    // //    dd($kegiatan);
    //     $mediaTransfer = mediaTransfer::where('kegiatan_id', $kegiatan->id)->get();
    //     // dd($mediaTransfer);
    //     $panitia = Panitia::where('kegiatan_id', $kegiatan->id)->get();
    //     return view('Adminn.edit',compact('kegiatan','mediaTransfer','panitia','user'));
    // }
    // public function updateprofil(Request $request, User $user, Kegiatan $kegiatan)
    // {  
    //     // dd($request->kebutuhan_biaya);
    //     $this->validate($request,[
    //         'nama' => 'required',
    //         'alamat' => 'required',
    //         'no_hp' => 'required',
    //         'file_pendukung' => 'mimes:pdf,docx,jpg,png',
    //         'foto' => 'mimes:jpg,png'

    //     ]);
    //     $kegiatan->nama = $request->nama;
    //     $kegiatan->alamat = $request->alamat;
    //     $kegiatan->no_hp = $request->no_hp;
    //     $kegiatan->target_donasi = currencyIDRToNumeric($request->target_donasi);
    //     if($request->hasFile('file_pendukung')){
    //         $request->file('file_pendukung')->move('pendukung',$request->file('file_pendukung')->getClientOriginalName());
    //         $kegiatan->file_pendukung=$request->file('file_pendukung')->getClientOriginalName();
    //     }
    //     $kegiatan->batas_donasi = $request->batas_donasi;
    //     if($request->hasFile('foto')){
    //         $request->file('foto')->move('images/kegiatan',$request->file('foto')->getClientOriginalName());
    //         $kegiatan->foto=$request->file('foto')->getClientOriginalName();
    //         $kegiatan->save();
    //     }
    //     $kegiatan->save();
    //     return redirect('admin/'.$user->id.'/'.$kegiatan->id.'/dashboard')->with('sukses','Data berhasil diupdate');
    // }
    
}
