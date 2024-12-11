@extends('welcome')
@section('content')
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb"><a href="#">Home</a>/ <a href="#">Detail Kamar</a>   /  Form Pemesanan</span>
        
        <h3>Form Pemesanan</h3>
      </div>
    </div>
  </div>
</div>

<div class="single-property section">
  <div class="container">
    <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <div class="card">
              <div class="card-header fw-bold">
                Data Diri anda
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="fw-bold">Nama anda : </span> {{ Auth::user()->name }}</li>
                <li class="list-group-item"><span class="fw-bold">Email anda : </span> {{ Auth::user()->email }}</li>
                <li class="list-group-item"><span class="fw-bold">Nomor Telepon anda : </span>+ {{ Auth::user()->no_tlp }}</li>
                <form action="{{ route('dashboard.kamar.store') }}"  method="post">
                  @csrf
                <li class="list-group-item d-flex align-items-center">
                  <span class="fw-bold">
                    <label for="check_in">Tanggal Check In</label> 
                   : 
                  </span>
                  <input id="check_in" name="check_in" type="date" class="form-control ms-3" style="width: 20%">
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <span class="fw-bold">
                    <label for="check_in">Jumlah Malam</label> 
                   : 
                  </span>
                  <input id="malam" name="malam" type="number" min="1" max="5" class="form-control ms-3" style="width: 20%">
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <span class="fw-bold">
                    <label for="check_out">Tanggal Check Out</label> 
                    : 
                  </span>
                  <input id="check_out" name="check_out" type="text" class="form-control ms-3" readonly  style="width: 20%">
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <span class="fw-bold">
                    <label for="check_in">Kamar</label> 
                   : 
                  </span>
                  <select class="form-select ms-3" aria-label="Default select example" name="kamar_id" style="width: 50%">
                    @foreach ($kamar as $kamar)
                      @if ($kamar->status == 'Tersedia' && $kamar->id_tipe_kamar == $tipe_kamar->id)
                      <option value="{{ $kamar->id }}" >Kamar No {{ $kamar->no_kamar }}  -- {{ $kamar->tipe_kamar->nama_kamar }}</option>
                      @endif
                    @endforeach
                  </select>
                </li>
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
              </ul>
            </div>
            <small style="font-size: 0.8rem">*Pastikan data diri sudah sesuai jika berbeda silakan ubah di profil anda</small>
          </div>
          <div class="main-content mt-5">
             
          </div> 
          </div>
          <div class="col-lg-4">
            <div class="info-table" >
            <ul>
              <li>
                <span>Tipe Kamar :<br><h4>{{ $tipe_kamar->nama_kamar }}</h4></span>
              </li>
              <li>
                <span>Harga Per Malam  :<br><h4>Rp.{{ number_format($tipe_kamar->harga,0,0,'.' ) }}</h4></span>
              </li>
              <li>
                <span>Total Harga :<br><h4 id="total_harga">Rp.0</h4></span>
              </li>
              <li>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Reservasi</button>
                </div>
              </form>
              </li>
            </ul>
          </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  const checkInInput = document.getElementById('check_in');
  const nightsInput = document.getElementById('malam');
  const checkOutInput = document.getElementById('check_out');
  const totalHargaElement = document.getElementById('total_harga');
  const hargaPerMalam = {{ $tipe_kamar->harga }};

  function calculateCheckOutAndTotal() {
      const checkInDate = new Date(checkInInput.value);
      const nights = parseInt(nightsInput.value, 10);
      if (!isNaN(checkInDate) && !isNaN(nights) && nights > 0) {
          const checkOutDate = new Date(checkInDate);
          checkOutDate.setDate(checkInDate.getDate() + nights);
          checkOutInput.value = checkOutDate.toISOString().split('T')[0];
          const totalHarga = nights * hargaPerMalam;
          totalHargaElement.textContent = `Rp.${totalHarga.toLocaleString('id-ID')}`;
      } else {
          checkOutInput.value = '';
          totalHargaElement.textContent = 'Rp.0';
      }
  }

  checkInInput.addEventListener('change', calculateCheckOutAndTotal);
  nightsInput.addEventListener('input', calculateCheckOutAndTotal);
});

</script>
@endsection