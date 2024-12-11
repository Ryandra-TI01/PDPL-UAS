@extends('welcome')
@section('content')
<div class="owl-carousel owl-banner">
    <div class="item item-1">
      <div class="header-text">
        <span class="category">Family <em>Rooms</em></span>
        <h2 class="">Hurry!<br>Get the Best Rooms for you</h2>
      </div>
    </div>
    <div class="item item-2">
      <div class="header-text">
        <span class="category">Premier <em>Rooms</em></span>
        <h2 class="">Be Quick!<br>Get the best Rooms in town</h2>
      </div>
    </div>
    <div class="item item-3">
      <div class="header-text">
        <span class="category">Deluxe <em>Rooms</em></span>
        <h2 class="">Act Now!<br>Get the highest level Rooms</h2>
      </div>
    </div>
  </div>
</div>

<div class="featured section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="left-image">
          <img src="{{ asset('VillaAgency-1.0.0') }}/assets/images/gallery_room.jpg" alt="">
          <a href="{{ route('dashboard.kamar') }}"><img src="{{ asset('VillaAgency-1.0.0') }}/assets/images/featured-icon.png" alt="" style="max-width: 60px; padding: 0px;"></a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="section-heading">
          <h6>| Featured</h6>
          <h2>Best Hotel &amp; Garden and Sky view</h2>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="video section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading text-center">
          <h6>| Video View</h6>
          <h2>Get Closer View & Different Feeling</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="video-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="video-frame">
          <img src="{{ asset('VillaAgency-1.0.0') }}/assets/images/video-frame.jpg" alt="">
          <a href="https://youtube.com" target="_blank"><i class="fa fa-play"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fun-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="wrapper">
          <div class="row">
            <div class="col-lg-4">
              <div class="counter">
                <h2 class="timer count-title count-number" data-to="50" data-speed="1000"></h2>
                  <p class="count-text ">Our<br>Hotel</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="counter">
                <h2 class="timer count-title count-number" data-to="20" data-speed="1000"></h2>
                <p class="count-text ">Years<br>Experience</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="counter">
                <h2 class="timer count-title count-number" data-to="24" data-speed="1000"></h2>
                <p class="count-text ">Awwards<br>Won</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="properties section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="section-heading text-center">
          <h6>| Properties</h6>
          <h2>We Provide The Best Rooms You Like</h2>
        </div>
      </div>
    </div>
    <div class="row">
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

<div class="contact section" id="contact_us">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading text-center">
          <h6 >| Contact Us</h6>
          <h2>Get In Touch With Our Customers Service</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="contact-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63461.977453910695!2d106.7751691158261!3d-6.21436241316561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1721391230790!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="500px" frameborder="0" style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);" allowfullscreen=""></iframe>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="item phone">
                <img src="{{ asset('VillaAgency-1.0.0') }}/assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                <h6>010-020-0340<br><span>Phone Number</span></h6>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="item email">
                <img src="{{ asset('VillaAgency-1.0.0') }}/assets/images/email-icon.png" alt="" style="max-width: 52px;">
                <h6>info@villa.co<br><span>Business Email</span></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <form id="contact-form" action="" method="post">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="name" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Subject</label>
                  <input type="subject" name="subject" id="subject" placeholder="Subject..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="message">Message</label>
                  <textarea name="message" id="message" placeholder="Your Message"></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection