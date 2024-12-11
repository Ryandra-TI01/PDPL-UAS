@extends('welcome')
@section('content')
<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="/">Home</a>  / Keranjang Pemesanan</span>
          <h3>Keranjang Pemesanan</h3>
        </div>
      </div>
    </div>
</div>
@if (session('success'))
<div class="container mt-5">
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
</div>
@endif
<div class="container mt-5">
    <div class="row">
    @foreach ($pemesanan as $pemesanan)
        <div class="col-12">
              <table class="table mb-5 text-center">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Tipe Kamar</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $pemesanan->kamar->tipe_kamar->nama_kamar }} </td>
                    <td>Rp {{ number_format($pemesanan->total_harga,0,0,'.') }}</Rp></td>      
                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->translatedFormat('l, d F Y') }}</Rp></td>      
                      @if ( $pemesanan->status_pembayaran == 'settlement')
                      <td><span class="fw-bold badge text-bg-success p-2" style="font-size:0.8rem">Berhasil</span></td>
                      <td><a class="link-cart" href="/dashboard/kamar/detail-pemesanan/{{ $pemesanan->id }}">Detail Pesanan</a></td>
                      @elseif ($pemesanan->status_pembayaran == 'pending')
                        <td><span class="fw-bold badge text-bg-warning p-2" style="font-size:0.8rem">Tertunda</span></td>
                        <td><a class="link-cart" href="/checkout/{{ $pemesanan->id }}">Bayar Sekarang</a></td>
                      @elseif ($pemesanan->status_pembayaran == 'deny')
                        <td><span class="fw-bold badge text-bg-danger p-2" style="font-size:0.8rem">Gagal</span> </td> 
                        <td><a class="link-cart" href="/dashboard/kamar/detail-pemesanan/{{ $pemesanan->id }}">Detail Pesanan</a></td>     
                      @elseif ($pemesanan->status_pembayaran == 'expire')
                        <td><span class="fw-bold badge text-bg-danger p-2" style="font-size:0.8rem">Kadaluarsa</span></td>     
                        <td><a class="link-cart" href="/dashboard/kamar/detail-pemesanan/{{ $pemesanan->id }}">Detail Pesanan</a></td>       
                      @elseif ($pemesanan->status_pembayaran == 'cancel')
                      <td><span class="fw-bold badge text-bg-danger p-2" style="font-size:0.8rem">Dibatalkan</span></td>
                      <td><a class="link-cart" href="/dashboard/kamar/detail-pemesanan/{{ $pemesanan->id }}">Detail Pesanan</a></td>     
                      @else
                      <td><span class="fw-bold badge text-bg-warning p-2" style="font-size:0.8rem">Belum Dibayar</span></td>
                      <td><a class="link-cart" href="/checkout/{{ $pemesanan->id }}">Bayar Sekarang</a></td>
                      @endif
                  </tr>
                </tbody>
              </table>
        </div>
        @endforeach 
    </div>
</div>
<div class="section best-deal">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>| Best Deal</h6>
            <h2>Find Your Best Deal Right Now!</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment" aria-selected="true">Appartment</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button" role="tab" aria-controls="villa" aria-selected="false">Villa House</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse" type="button" role="tab" aria-controls="penthouse" aria-selected="false">Penthouse</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>540 m2</span></li>
                          <li>Floor number <span>3</span></li>
                          <li>Number of rooms <span>8</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-01.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>All Info About Apartment</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, do eiusmod tempor pack incididunt ut labore et dolore magna aliqua quised ipsum suspendisse. <br><br>Swag fanny pack lyft blog twee. JOMO ethical copper mug, succulents typewriter shaman DIY kitsch twee taiyaki fixie hella venmo after messenger poutine next level humblebrag swag franzen.</p>
                      <div class="icon-button">
                        <a href="#"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="villa" role="tabpanel" aria-labelledby="villa-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>250 m2</span></li>
                          <li>Floor number <span>26th</span></li>
                          <li>Number of rooms <span>5</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-02.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Detail Info About New Villa</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, do eiusmod tempor pack incididunt ut labore et dolore magna aliqua quised ipsum suspendisse. <br><br>Swag fanny pack lyft blog twee. JOMO ethical copper mug, succulents typewriter shaman DIY kitsch twee taiyaki fixie hella venmo after messenger poutine next level humblebrag swag franzen.</p>
                      <div class="icon-button">
                        <a href="#"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="penthouse" role="tabpanel" aria-labelledby="penthouse-tab">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="info-table">
                        <ul>
                          <li>Total Flat Space <span>320 m2</span></li>
                          <li>Floor number <span>34th</span></li>
                          <li>Number of rooms <span>6</span></li>
                          <li>Parking Available <span>Yes</span></li>
                          <li>Payment Process <span>Bank</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <img src="assets/images/deal-03.jpg" alt="">
                    </div>
                    <div class="col-lg-3">
                      <h4>Extra Info About Penthouse</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, do eiusmod tempor pack incididunt ut Kinfolk tonx seitan crucifix 3 wolf moon bicycle rights keffiyeh snackwave wolf same vice, chillwave vexillologistlabore et dolore magna aliqua quised ipsum suspendisse. <br><br>Swag fanny pack lyft blog twee. JOMO ethical copper mug, succulents typewriter shaman DIY kitsch twee taiyaki fixie hella venmo after messenger poutine next level humblebrag swag franzen.</p>
                      <div class="icon-button">
                        <a href="#"><i class="fa fa-calendar"></i> Schedule a visit</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection