<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\kegiatan;
use App\Models\mediaTransfer;
use App\Models\Panitia;
use App\Models\Donatur;
use App\Models\Berita;
use carbon\Carbon;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('layouts.master');
    }

    public function create(Request $request, user $user)
    { 
        return view(('superAdmin.create'),compact('user'));
    }

    public function store(Request $request)
    { 
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:12|max:15',
            'target_donasi' => 'required',
            'file_pendukung' => 'file',
            'batas_donasi' => 'required',
            'nomor' => 'required|numeric',
            'nama_pemilik' => 'required',
            'nama_panitia' => 'required',
            'nama_media' => 'required',
            'alamat_panitia' => 'required',
            'no_telp' => 'required|min:12|max:15',
        ]);
        $user = new User;
        $user->role = 'admin';
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = str::random(60);
        $user->save();
        $request->request->add(['users_id'=>$user->id]);

        $kegiatan = new Kegiatan;
        $kegiatan->nama = $request->nama;
        $kegiatan->users_id = $request->users_id;
        $kegiatan->alamat = $request->alamat;
        $kegiatan->no_hp = $request->no_hp;
        $kegiatan->target_donasi = currencyIDRToNumeric($request->target_donasi);
        $kegiatan->file_pendukung = $request->file_pendukung;
        $kegiatan->batas_donasi = $request->batas_donasi;
        if($request->hasFile('file_pendukung')){
            $request->file('file_pendukung')->move('files/',$request->file('file_pendukung')->getClientOriginalName());
            $kegiatan->file_pendukung=$request->file('file_pendukung')->getClientOriginalName();
            $kegiatan->save(); 
        }
        $kegiatan->save(); 
        $request->request->add(['kegiatan_id'=>$kegiatan->id]);

        $mediaTransfer = MediaTransfer::create($request->all());
        
        $panitia = new Panitia;
        $panitia->nama = $request->nama_panitia;
        $panitia->alamat = $request->alamat_panitia;
        $panitia->no_telp = $request->no_telp;
        $panitia->kegiatan_id = $request->kegiatan_id;
        $panitia->save();
        return redirect('/superAdmin')->with('sukses','Data berhasil ditambah');
    }

    public function info(Kegiatan $kegiatan)
    {
        $sekarang = Carbon::now();
        $user = $kegiatan->users_id;
        $mediaTransfer = mediaTransfer::where('kegiatan_id',$kegiatan->id)->where('nama_media','!=','Donasi Langsung')->get();
        $panitia = Panitia::where('kegiatan_id',$kegiatan->id)->get();
        // dd($panitias);
        $donatur = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',2)->get();
        // dd($panitia);
        return view('superAdmin.info',compact('kegiatan','mediaTransfer','panitia','donatur','user','sekarang'));
    }

    public function edit(Kegiatan $kegiatan, Panitia $panitia, MediaTransfer $mediaTransfer)
    {   
    //    dd($kegiatan->batas_donasi);
        $mediaTransfer = Kegiatan::all();
        $mediaTransfer = mediaTransfer::all();
        $panitia = Panitia::all();
       
       
        return view('superAdmin.edit',compact('kegiatan','mediaTransfer','panitia'));
    }

    public function update(Request $request, Kegiatan $kegiatan, Panitia $panitia, MediaTransfer $mediaTransfer)
    {  
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:12|max:15',
            'target_donasi' => 'required',
            'file_pendukung' => 'mimes:pdf,docx,jpg,png',
            'batas_donasi' => 'required',
            'foto' => 'mimes:jpg,png'

        ]);
        // dd($user->id);
        $kegiatan->nama = $request->nama;
        $kegiatan->alamat = $request->alamat;
        $kegiatan->no_hp = $request->no_hp;
        $kegiatan->target_donasi = currencyIDRToNumeric($request->target_donasi);
        // $kegiatan->file_pendukung = $request->file_pendukung;
        if($request->hasFile('file_pendukung')){
            $request->file('file_pendukung')->move('pendukung',$request->file('file_pendukung')->getClientOriginalName());
            $kegiatan->file_pendukung=$request->file('file_pendukung')->getClientOriginalName();
        }
        $kegiatan->batas_donasi = $request->batas_donasi;
        $kegiatan->save();
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/kegiatan',$request->file('foto')->getClientOriginalName());
            $kegiatan->foto=$request->file('foto')->getClientOriginalName();
            $kegiatan->save();
        }
       
            return redirect('kegiatan/'.$kegiatan->id.'/info')->with('sukses','Data berhasil diupdate');
    }

    public function File(User $user, Kegiatan $kegiatan){
        return response()->download('files/'.$kegiatan->file_pendukung);
        // $data = Kegiatan::where('id',$kegiatan->id)->where('users_id',$user->id)->first();
        // if(auth()->user()->role == 'super admin'){

        //     return view('superAdmin.file', compact('data'));
        // }
        
		// if(auth()->user()->role == 'admin'){
        //     // dd($data);
        //         return view('Adminn.file', compact('data'));
        //     }
    }
   

}
