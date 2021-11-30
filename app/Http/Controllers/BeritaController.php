<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\Donatur;
use carbon\Carbon;

class BeritaController extends Controller
{
    public function index(User $user, Kegiatan $kegiatan)
    {
        // $user = User::where('id',$user)->get();
        // dd($user);
        $berita = Berita::where('kegiatan_id',$kegiatan->id)->orderBy('created_at','DESC')->limit(1)->first();  
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        if(!empty($berita)){
            $galeri = Galeri::where('berita_id',$berita->id)->first();
            return view('berita.index',compact('user', 'kegiatan', 'berita', 'galeri','valid','validd'));
        }
        // dd($galeri);
        // $berita = Berita::all();
        // dd($berita);
        // $galeri = Galeri::where('berita_id', $berita->id)->first();  
        // dd($galeri);
        return view('berita.index',compact('user', 'kegiatan', 'berita','valid','validd'));
    }
    public function create(User $user, Kegiatan $kegiatan)
    {
        $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
        $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
        return view('berita.create',compact('user', 'kegiatan','valid','validd'));
    }
    public function store(Request $request, User $user, Kegiatan $kegiatan)
    {
        // dd($request->all());
        $this->validate($request,[
            'judul' => 'required',
            'thumbnail' => 'required|mimes:jpg,png',
            'foto' => 'required',
            'isi' => 'required'
        ]);
        $berita = new Berita;
        $berita->kegiatan_id = $request->kegiatan_id;
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        if($request->hasFile('thumbnail')){
            $request->file('thumbnail')->move('files/berita/thumbnail',$request->file('thumbnail')->getClientOriginalName());
            $berita->thumbnail=$request->file('thumbnail')->getClientOriginalName();
            $berita->save(); 
        }
        $request->request->add(['berita_id'=>$berita->id]);
       
        $files = [];
        $a = 0;
        foreach($request->file('foto') as $file)
        {     
        if($request->hasfile('foto'))
           {
              $path = $file->move('files/berita',$file->getClientOriginalName());
              $files[] = [
                  'berita_id' => $berita->id,
                  'foto' => $file->getClientOriginalName(),
                  'created_at' => $now = Carbon::now(),
                  'updated_at' => $now,
              ];
           }
         $a++;  
        }
        Galeri::insert($files);
        return redirect ('postingan/'.$user->id.'/'.$kegiatan->id.'/index')->with('sukses','Postingan berhasil diupload');
        }
        public function show(User $user, Kegiatan $kegiatan, Berita $berita)
        {
            $galeris = Galeri::where('berita_id',$berita->id)->get();
            $beritas = Berita::where('id',$berita->id)->first();
            $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
            $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
            // dd($beritas);
            return view('berita.show',compact('user', 'kegiatan', 'beritas', 'galeris','valid','validd'));
        }
        public function edit(User $user, Kegiatan $kegiatan, Berita $berita)
        {
            $valid = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->get(); //status 1 untuk donatur yang belum tervalidasi
            $validd = Donatur::where('kegiatan_id',$kegiatan->id)->where('status',1)->orderBy('created_at','asc')->take(5)->get();
            $galeris = Galeri::where('berita_id',$berita->id)->get();
            $beritas = Berita::where('id',$berita->id)->first();
            // dd($beritas);
            return view('berita.edit',compact('user', 'kegiatan', 'beritas', 'galeris','valid','validd'));
        }
        public function update(Request $request, User $user, Kegiatan $kegiatan, Berita $berita)
        {
            // dd($request->all());
            // $this->validate($request, [
            //     
            // 'file.*' => 'required|file|max:20000', // max 2MB
            // ]);
            $this->validate($request,[
                'judul' => 'required',
                'thumbnail' => 'mimes:jpg,png',
                'foto' => 'required',
                'isi' => 'required'
            ]);
    
            $galeri = Galeri::where('berita_id',$berita->id)->get();
            $berita->judul = $request->judul;
            $berita->isi = $request->isi;
            if($request->hasFile('thumbnail')){
                $request->file('thumbnail')->move('files/berita/thumbnail',$request->file('thumbnail')->getClientOriginalName());
                $berita->thumbnail=$request->file('thumbnail')->getClientOriginalName();
                $berita->save(); 
            }
            $berita->save();
            $files = [];
            $a = 0;
            if($request->hasfile('foto'))
            {     
            foreach($request->file('foto') as $file)
               {     
                  $galeri = Galeri::where('berita_id', $berita->id)->delete();
                  $path = $file->move('files/berita',$file->getClientOriginalName());
                  $files[] = [
                      'berita_id' => $berita->id,
                      'foto' => $file->getClientOriginalName(),
                      'created_at' => $now = Carbon::now(),
                      'updated_at' => $now,
                  ];
                  $a++;  
                }
                Galeri::insert($files);
            }
            // Galeri::update($request->all());
            // dd($beritas);
            return redirect('postingan/'.$user->id.'/'.$kegiatan->id.'/index')->with('sukses','Data berhasil diupdate');
        }
        public function delete($user, $kegiatan, $berita)
        {
            
            $galeri = Galeri::where('berita_id', $berita)->delete();
            $berita = Berita::where('id', $berita)->delete();
            // dd($user1->all());
          
            return redirect()->back()->with('sukses1', 'Postingan berhasil dihapus');
        }
        public function lihat(Berita $berita)
        {
            $kegiatan = Kegiatan::where('id',$berita->kegiatan_id)->first();
            $user = User::where('id',$kegiatan->users_id)->first();
            $galeris = Galeri::where('berita_id',$berita->id)->get();
            
            return view('berita.lihat',compact('berita', 'galeris','user'));
            }
    
}
