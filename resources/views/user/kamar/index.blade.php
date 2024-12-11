@extends('welcome')
@section('content')
<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / Kamar</span>
          <h3>Kamar</h3>
        </div>
      </div>
    </div>
</div>

@auth
<div class="container mt-5 mb-5 d-flex justify-content-end">
  <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
    Pesan Kamar +
  </button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pemesanan Kamar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
              <div class="card-header bg-primary text-white">Data Diri</div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <tbody>
                          <tr>
                              <th scope="row">Nama Pelanggan</th>
                              <td>{{ Auth::user()->name }}</td>
                          </tr>
                          <tr>
                              <th scope="row">Email</th>
                              <td>{{ Auth::user()->email }}</td>
                          </tr>
                          <tr>
                              <th scope="row">Check-in</th>
                              <td>+ {{ Auth::user()->no_tlp }}</td>
                          </tr>
                          <tr>
                              <th scope="row">Check-out</th>
                              <td>{{ Auth::user()->asal_kota }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <small style="font-size: 0.8rem">*Pastikan data diri sudah sesuai jika berbeda silakan ubah di profil anda</small>

          <form action="{{ route('dashboard.kamar.store') }}" method="post">
            @csrf
            <div class="mb-3 mt-3">
              <label for="tipe_kamar">Tipe Kamar</label>
              <select class="form-select" aria-label="Default select example" id="tipe_kamar" name="tipe_kamar">
                <option value="" selected disabled>Pilih Tipe Kamar</option>
                @foreach ($tipe_kamars as $tipe_kamar)
                <option value="{{ $tipe_kamar->id }}" data-harga="{{ $tipe_kamar->harga }}">
                  {{ $tipe_kamar->nama_kamar }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="kamar_id">Kamar Tersedia</label>
              <select class="form-select" id="kamar_id" name="kamar_id">
                <option value="" selected disabled>Pilih Kamar</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="check_in" class="col-form-label">Check In:</label>
              <input id="check_in" name="check_in" type="date" class="form-control">
            </div>
            <div class="mb-3">
              <label for="malam">Jumlah Malam</label>
              <input id="malam" name="malam" type="number" min="1" max="5" class="form-control">
            </div>
            <div class="mb-3">
              <label for="check_out">Tanggal Check Out</label>
              <input id="check_out" name="check_out" type="text" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="total_harga">Total Harga</label>
              <input id="total_harga" name="total_harga" type="text" class="form-control" readonly>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Pesan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endauth

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen select
    const tipeKamarSelect = document.getElementById('tipe_kamar');
    const kamarSelect = document.getElementById('kamar_id');
    const checkInInput = document.getElementById('check_in');
    const nightsInput = document.getElementById('malam');
    const checkOutInput = document.getElementById('check_out');
    const totalHargaElement = document.getElementById('total_harga');

    // Data kamar sebagai array of object
    const kamarData = [
      @foreach ($kamar as $k)
      {
        id: {{ $k->id }},
        no_kamar: "{{ $k->no_kamar }}",
        status: "{{ $k->status }}",
        id_tipe_kamar: {{ $k->id_tipe_kamar }},
        nama_kamar: "{{ $k->tipe_kamar->nama_kamar }}"
      },
      @endforeach
    ];

    let hargaPerMalam = 0; // Harga per malam akan diperbarui berdasarkan pilihan tipe kamar

    // Event listener untuk perubahan tipe kamar
    tipeKamarSelect.addEventListener('change', function () {
      // Ambil tipe kamar yang dipilih
      const selectedTipeKamarId = parseInt(this.value);
      
      // Perbarui harga per malam berdasarkan pilihan tipe kamar
      const selectedOption = this.options[this.selectedIndex];
      hargaPerMalam = parseFloat(selectedOption.getAttribute('data-harga'));

      // Filter kamar berdasarkan tipe kamar yang dipilih
      const kamarTersedia = kamarData.filter(kamar =>
        kamar.status === 'Tersedia' && kamar.id_tipe_kamar === selectedTipeKamarId
      );

      // Kosongkan pilihan kamar sebelumnya
      kamarSelect.innerHTML = '<option value="" selected disabled>Pilih Kamar</option>';

      // Tambahkan opsi baru ke dalam select kamar
      kamarTersedia.forEach(kamar => {
        const option = document.createElement('option');
        option.value = kamar.id;
        option.textContent = `Kamar No ${kamar.no_kamar} - ${kamar.nama_kamar}`;
        kamarSelect.appendChild(option);
      });

      // Hitung ulang total harga
      calculateCheckOutAndTotal();
    });

    // Fungsi untuk menghitung tanggal check-out dan total harga
    function calculateCheckOutAndTotal() {
      const checkInDate = new Date(checkInInput.value);
      const nights = parseInt(nightsInput.value, 10);

      if (!isNaN(checkInDate) && !isNaN(nights) && nights > 0) {
        const checkOutDate = new Date(checkInDate);
        checkOutDate.setDate(checkInDate.getDate() + nights);
        checkOutInput.value = checkOutDate.toISOString().split('T')[0];

        const totalHarga = nights * hargaPerMalam;
        // Format total harga agar lebih mudah dibaca
        totalHargaElement.value = totalHarga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }); 
      } else {
        checkOutInput.value = '';
        totalHargaElement.value = 'Rp0,00';
      }
    }

    checkInInput.addEventListener('change', calculateCheckOutAndTotal);
    nightsInput.addEventListener('input', calculateCheckOutAndTotal);
  });
</script>
<div class="properties">
    <div class="container">
      <div class="row properties-box">
        @foreach ($tipe_kamars as $tipe_kamar)            
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
          <div class="item">
            <a href="/dashboard/kamar/{{ $tipe_kamar->id }}"><img src="{{ Storage::url($tipe_kamar->gambar_kamar) }}"></a>
            <span class="category">Hotel Rooms</span>
            <h6>Rp.{{ number_format($tipe_kamar->harga, 0, ',', '.') }}</h6>
            <h4><a href="/dashboard/kamar/{{ $tipe_kamar->id }}">{{ $tipe_kamar->nama_kamar }}</a></h4>
            <ul>
              {!! $tipe_kamar->fasilitas !!}
            </ul>
            <div class="main-button">
              <a href="/dashboard/kamar/{{ $tipe_kamar->id }}">Cek Kamar</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
</div>


@endsection
