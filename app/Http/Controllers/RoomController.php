<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Notifications;
use App\Models\Pemesanan;
use App\Models\Tipe_Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;

class RoomController extends Controller
{
    public function index(){
        $kamar = Kamar::all();
        $tipe_kamars = Tipe_Kamar::all();
        return view('user.kamar.index',compact(['tipe_kamars','kamar']));
    }
    public function show($id){
        $tipe_kamar = Tipe_Kamar::findOrFail($id);
        return view('user.kamar.show',compact('tipe_kamar'));
    }
    public function cart(){
        $user = auth()->user();
        $pemesanan = Pemesanan::where('user_id', $user->id)->orderBy('created_at','desc')->get();
    
        $pemesanan->each(function ($pemesanan) {
            $pemesanan->check_in = Carbon::parse($pemesanan->check_in)->translatedFormat('l, d F Y');
            $pemesanan->check_out = Carbon::parse($pemesanan->check_out)->translatedFormat('l, d F Y');
        });
    
        return view('user.kamar.cart', [
            'pemesanan' => $pemesanan,
        ]);
    }
    public function create($id){
        $tipe_kamar = Tipe_Kamar::findOrFail($id);
        $kamar = Kamar::all();
        return view('user.kamar.create',compact(['tipe_kamar','kamar']));
    }
    public function store(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'malam' => 'required|integer|min:1',
            'kamar_id' => 'required|exists:kamar,id',
        ]);
    
        $check_in = Carbon::parse($request->check_in);
        $malam = (int) $request->malam;
        $check_out = $check_in->copy()->addDays($malam);
        $kamar = Kamar::findOrFail($request->kamar_id);
        $total_harga = $request->malam * $kamar->tipe_kamar->harga;
    
        $pemesanan = Pemesanan::create([
            'check_in' => $check_in,
            'check_out' => $check_out,
            'malam' => $request->malam,
            'user_id' => $request->user_id,
            'kamar_id' => $request->kamar_id,
            'total_harga' => $total_harga,
        ]);
        Notifications::create([
            'title' => 'New booking received',
            'message' => 'A new booking has been received. Check details for more info.',
            'type' => 'booking',
        ]);
    
        $kamar->status = 'Tidak Tersedia';
        $kamar->save();
    
        return redirect()->route('dashboard.checkout', ['id' => $pemesanan->id])->with('success', 'Reservasi Berhasil Mohon Untuk Segera Dibayar');
    }
    public function detailPesanan($id){
        $pemesanan = Pemesanan::findOrFail($id);
        return view('user.kamar.detail',compact('pemesanan'));
    }
    public function checkout($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $pemesanan->kode_pesanan,
                'gross_amount' => $pemesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $pemesanan->user->name,
                'last_name' => '', // Jika ada
                'email' => $pemesanan->user->email,
                'phone' => $pemesanan->user->no_tlp,
            ],
            'item_details' => [
                [
                    'id' => $pemesanan->kamar->id,
                    'price' => $pemesanan->kamar->tipe_kamar->harga,
                    'quantity' => $pemesanan->malam,
                    'name' => 'Kamar ' . $pemesanan->kamar->tipe_kamar->nama_kamar,
                ],
            ],
            'billing_address' => [
                'first_name' => $pemesanan->user->name,
                'last_name' => '', // Jika ada
                'email' => $pemesanan->user->email,
                'phone' => $pemesanan->user->no_tlp,
            ],
        ];

        try {
            // Membuat Snap Token
            $snapToken = Snap::getSnapToken($params);
            Log::info('Snap Token: ' . $snapToken);

            return view('user.kamar.checkout', compact('pemesanan', 'snapToken'));
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return redirect()->route('dashboard.cart')->with('error', 'Terjadi kesalahan saat membuat pembayaran.');
        }
    }
    public function notificationHandler(Request $request)
    {
        // Log the incoming request for debugging
        Log::info("Received notification: ", $request->all());
        
        $notification = new \Midtrans\Notification();
        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;
    
        $pemesanan = Pemesanan::where('kode_pesanan', $orderId)->first();
    
        if (!$pemesanan) {
            Log::error("Pemesanan with order ID: $orderId not found");
            return response()->json(['message' => 'Pemesanan not found'], 404);
        }
    
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $pemesanan->status_pembayaran = 'challenge';
                } else {
                    $pemesanan->status_pembayaran = 'success';
                }
            }
        } else if ($transaction == 'settlement') {
            $pemesanan->status_pembayaran = 'settlement';
        } else if ($transaction == 'pending') {
            $pemesanan->status_pembayaran = 'pending';
        } else if ($transaction == 'deny') {
            $pemesanan->status_pembayaran = 'deny';
        } else if ($transaction == 'expire') {
            $pemesanan->status_pembayaran = 'expire';
        } else if ($transaction == 'cancel') {
            $pemesanan->status_pembayaran = 'cancel';
        }
    
        $pemesanan->save();
        Log::info("Updated pemesanan status to: {$pemesanan->status_pembayaran} for order ID: $orderId");
    
        return response()->json(['message' => 'Notification processed'], 200);
    }
    
    public function finish(Request $request)
    {
        $user = auth()->user();
        $pemesanan = Pemesanan::where('user_id',$user->id)->get();
        return view('user.kamar.cart',compact('pemesanan'));
    }


}
