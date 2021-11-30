<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kegiatan;
use App\Models\mediaTransfer;
use App\Models\Panitia;

class PanitiaController extends Controller
{
    public function create(Request $request, Panitia $panitia, Kegiatan $kegiatan)
    { 
        // dd($request->all());
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|min:12|max:15',
        ]);
        Panitia::create($request->all());
        return redirect()->back()->with('sukses', 'Panitia berhasil ditambahkan');
    }
    public function update(Request $request, Panitia $panitia, Kegiatan $kegiatan)
    { 
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|min:12|max:15',
        ]);
        $panitia->update($request->all());
        $panitia->save();
        return redirect()->back()->with('sukses','Data berhasil diupdate');
    }

    public function delete(Panitia $panitia)
    {   
        $panitia->delete($panitia);
        return redirect()->back()->with('sukses', 'Panitia berhasil dihapus');

    }
}
