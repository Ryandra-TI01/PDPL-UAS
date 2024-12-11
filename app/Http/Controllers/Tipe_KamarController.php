<?php

namespace App\Http\Controllers;

use App\Models\Tipe_Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Tipe_KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe_kamars= Tipe_Kamar::all();
        return view('admin.tipe_kamar.index',[
            'tipe_kamars'=>$tipe_kamars,     
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipe_kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'gambar_kamar'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);        
        
        $path = $request->file('gambar_kamar')->store('public/gambar_kamar');

        Tipe_Kamar::create([
            'nama_kamar'=> $request->nama_kamar,
            'harga'=> $request->harga,
            'fasilitas'=> $request->fasilitas,
            'gambar_kamar'=> $path,
        ]);
        return redirect()->route('admin.tipe_kamar')->with('success', 'Tipe Kamar Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipe_Kamar $tipe_Kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipe_kamar = Tipe_Kamar::findOrFail($id);
        return view('admin.tipe_kamar.edit', compact('tipe_kamar'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipe_kamar = Tipe_Kamar::findOrFail($id);
    
        $request->validate([
            'nama_kamar' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'fasilitas' => 'nullable|string',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('gambar_kamar')) {
            // Hapus gambar lama jika ada
            if ($tipe_kamar->gambar_kamar) {
                Storage::delete($tipe_kamar->gambar_kamar);
            }
            $path = $request->file('gambar_kamar')->store('public/gambar_kamar');
            $tipe_kamar->gambar_kamar = $path;
        }
    
        $tipe_kamar->nama_kamar = $request->nama_kamar;
        $tipe_kamar->harga = $request->harga;
        $tipe_kamar->fasilitas = $request->fasilitas;
        $tipe_kamar->save();
    
        return redirect()->route('admin.tipe_kamar')->with('success', 'Tipe Kamar Berhasil Diperbarui');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipe_kamar = Tipe_Kamar::findOrFail($id);
        $tipe_kamar->delete();

        return redirect()->route('admin.tipe_kamar')->with('success', 'Tipe Kamar Berhasil Dihapus.');
    }
}
