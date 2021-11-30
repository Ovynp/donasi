<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\kegiatan;
use App\Models\mediaTransfer;
use App\Models\Panitia;
use App\Models\Donatur;
use App\Models\Galeri;
use App\Models\Berita;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','admin')->get();
        return view('user.index', compact('users'));
    }

    public function create(Request $request)
    { 
        $user = new User;
        $user->role = 'admin';
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = str::random(60);
        $user->save();
        return redirect('kegiatan/'.$user->id.'/create')->with('sukses','Data berhasil diupdate');
    }

    public function delete($kegiatan, $user)
    {
        $berita = Berita::where('kegiatan_id', $user)->get();
        foreach($berita as $beritas){
            $galeri = Galeri::where('berita_id', $beritas->id)->delete();
        }
        $beritaa = Berita::where('kegiatan_id', $user)->delete();
        $mediaTransfer = MediaTransfer::where('kegiatan_id', $user)->delete();
        $panitia = Panitia::where('kegiatan_id', $user)->delete();
        $donatur = Donatur::where('kegiatan_id', $user)->delete();
        $kegiatann = Kegiatan::where('id', $user)->delete();
        $user1 = User::where('id', $kegiatan)->delete();
        // dd($user1->all());
      
        return redirect()->back()->with('sukses1', 'Kegiatan berhasil dihapus');
    }

    public function edit (User $user)
    {
        // $user = User::all();
        // dd($user->all());
        return view('user.edit',compact('user'));
    }

    public function update (Request $request, User $user)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $kegiatan = Kegiatan::where('users_id',$user->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/login')->with('sukses','Data berhasil diupdate, silahkan login kembali');
        // if (auth()->user()->role == 'super admin') 
        // {
        //     return redirect('/user')->with('sukses','Data berhasil diupdate');       
        // } 
        // elseif (auth()->user()->role == 'admin') 
        // { 
        //     return redirect('admin/'.$user->id.'/'.$kegiatan->id)->with('sukses','Data berhasil diupdate'); 
        // }
        
    }
    public function cari (Request $request)
    {
        if($request->has('cari')){
            $tampil= User::where('role','admin')->where('name','LIKE','%'.$request->cari.'%')->get();
        }else{
            $tampil = User::all();       
        }
        // dd($data_kegiatan);
        return view('user.cari',compact('tampil'));
    }
    public function updateuser (Request $request, User $user)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $kegiatan = Kegiatan::where('users_id',$user->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);
        $user->save();
            return redirect('/user')->with('sukses','Data berhasil diupdate');       
       
        
    }
}
