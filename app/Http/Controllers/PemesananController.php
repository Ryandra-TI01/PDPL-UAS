<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Tipe_Kamar;

class PemesananController extends Controller
{
    public function index()
    {
        $list_pemesanan = Pemesanan::all();
        return view('admin.pemesanan.index', compact('list_pemesanan'));
    }

    public function create()
    {
        $users = User::all();
        $tipe_kamar= Tipe_Kamar::all();
        $kamar= Kamar::all();
        return view('admin.pemesanan.create', compact('users', 'tipe_kamar', 'kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'kamar_id' => 'required',
            'user_id' => 'required',
        ]);

        $kamar = Kamar::find($request->kamar_id);
        $kamar->status = 'Tidak Tersedia';
        $kamar->save();

        Pemesanan::create([
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'kamar_id' => $request->kamar_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.pemesanan')->with('success', 'Pemesanan Berhasil Ditambahkan');
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $users = User::all();
        $tipe_kamar= Tipe_Kamar::all();
        $kamar= Kamar::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'tipe_kamar', 'kamar', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        

        $data = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'kamar_id' => 'required',
            'user_id' => 'required',
        ]);

        $pemesanan->update($data);

        return redirect()->route('admin.pemesanan')->with('success', 'Pemesanan Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->route('admin.pemesanan')->with('success', 'Pemesanan Berhasil Dihapus');
    }
}