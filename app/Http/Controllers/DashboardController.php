<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // Mengambil semua user
         $list_user = User::all();
         
         // Mengambil total pesanan per hari
         $totalPesananPerHari = Pemesanan::select(
             DB::raw('DATE(created_at) as date'),
             DB::raw('COUNT(*) as total_pesanan')
         )
         ->groupBy('date')
         ->orderBy('date', 'asc')
         ->get();
 
         // Mengambil total harga per hari
         $totalHargaPerHari = Pemesanan::select(
             DB::raw('DATE(created_at) as date'),
             DB::raw('SUM(total_harga) as total_harga')
         )
         ->groupBy('date')
         ->orderBy('date', 'asc')
         ->get();
         
         // Memastikan data tidak kosong
         if ($totalPesananPerHari->isEmpty() || $totalHargaPerHari->isEmpty()) {
             return back()->withErrors(['message' => 'No data available']);
         }
 
         // Ekstrak data tanggal, total pesanan, dan total harga
         $dates = $totalPesananPerHari->pluck('date');
         $totalPesanan = $totalPesananPerHari->pluck('total_pesanan');
         $totalHarga = $totalHargaPerHari->pluck('total_harga');
 
         $notifications = Notifications::where('is_read', false)->orderBy('created_at', 'desc')->get();
         // Mengirim data ke view
         return view('admin.dashboard.index', compact('dates', 'totalPesanan', 'totalHarga', 'list_user','notifications'));
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
