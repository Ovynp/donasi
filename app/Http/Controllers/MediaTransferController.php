<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kegiatan;
use App\Models\mediaTransfer;
use App\Models\Panitia;

class MediaTransferController extends Controller
{
    public function create(Request $request)
    { 
        $this->validate($request,[
            'nomor' => 'required|numeric',
            'nama_pemilik' => 'required',
            'nama_media' => 'required'
        ]);
        MediaTransfer::create($request->all());
        return redirect()->back()->with('sukses', 'Media transfer berhasil ditambahkan');
    }

    public function edit(MediaTransfer $mediaTransfer)
    {  
        $mediaTransfer = mediaTransfer::all();
        return view('superAdmin.edit',compact('mediaTransfer'));
    }

    public function update(Request $request, MediaTransfer $mediaTransfer, Kegiatan $kegiatan)
    {  
        $this->validate($request,[
            'nomor' => 'required|numeric',
            'nama_pemilik' => 'required',
            'nama_media' => 'required'
        ]);
        $mediaTransfer->nama_media = $kegiatan->id;
        $mediaTransfer->nama_media = $request->nama_media;
        $mediaTransfer->nomor = $request->nomor;
        $mediaTransfer->nama_pemilik = $request->nama_pemilik;
        $mediaTransfer->save();
        return redirect()->back()->with('sukses','Data berhasil diupdate');
    }

    public function delete(MediaTransfer $mediaTransfer)
    {   
        
        $mediaTransfer->delete($mediaTransfer);
        return redirect()->back()->with('sukses', 'Media Transfer berhasil dihapus');
    }
}
