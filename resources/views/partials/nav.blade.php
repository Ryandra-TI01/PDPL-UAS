<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<div class="sub-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <ul class="info">
          <li><i class="fa fa-envelope"></i>info@The Grand Palace Hotel.com</li>
          <li><i class="fa fa-map"></i>Sunny Isles Beach, FL 33160</li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-4">
        <ul class="social-links">
          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="main-nav">
                <!-- ***** Logo Start ***** -->
                <a href="/" class="logo">
                    <h1>The Grand Palace Hotel</h1>
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('dashboard.kamar') }}">Kamar</a></li>
                  <li><a href="/#contact_us">Contact Us</a></li>
                  @auth

                      @if (Auth::user()->role == 'admin')
                      <li class="ms-5">
                        <a class="mt-2" href="{{ route('dashboard.cart') }}">
                          <span class="material-symbols-outlined">
                            shopping_cart
                          </span>
                        </a>
                        <li>
                          <a href="/dashboard-admin" class="mt-2">
                            <span class="material-symbols-outlined">
                              support_agent
                            </span>
                          </a>
                        </li>
                      @else
                      <li class="ms-5">
                        <a class="mt-2" href="{{ route('dashboard.cart') }}">
                          <span class="material-symbols-outlined">
                            shopping_cart
                          </span>
                        </a>
                      </li>
                      <li>
                          <a class="mt-2" href="{{ route('profile.edit') }}">
                            <span class="material-symbols-outlined">
                              account_circle
                          </span>
                          </a>
                      </li>         
                      @endif

                    @else                        
                      <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a >|</a></li> 
                      <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                  <li class="d-none"><a href="#"> Schedule a visit</a></li>
                </ul>   
                <a class='menu-trigger'>
                  <span>Menu</span>
                </a>
                <!-- ***** Menu End ***** -->
            </nav>
        </div>
    </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->