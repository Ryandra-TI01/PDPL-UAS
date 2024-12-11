<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tipe_Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe_kamars = Tipe_Kamar::all();
        $kamars = Kamar::all();
        return view('admin.kamar.index',[
            'kamars'=>$kamars,
            'tipe_kamars'=>$tipe_kamars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipe_kamars = Tipe_Kamar::all();
        return view('admin.kamar.create',[
            'tipe_kamars'=>$tipe_kamars,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_kamar' => 'required|integer',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'id_tipe_kamar' => 'required|integer'
        ]);
        Kamar::create($data);
        return redirect()->route('admin.kamar')->with('success', 'kaamr Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipe_kamars = Tipe_Kamar::all();
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit',[
            'kamar'=>$kamar,
            'tipe_kamars'=>$tipe_kamars,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'no_kamar' => 'required|integer',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'id_tipe_kamar' => 'required|integer'
        ]);
        $kamar = Kamar::findOrFail($id);
        $kamar->update($data);
        return redirect()->route('admin.kamar')->with('success', 'Kamar Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();
        return redirect()->route('admin.kamar')->with('success', 'Kamar Berhasil Dihapus.');
    }
}
