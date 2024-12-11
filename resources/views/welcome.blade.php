<!DOCTYPE html>
<html lang="en">

@include('partials.head')
    <body>
        @include('partials.nav')
        <div class="main-banner">
          @yield('content')
        </div>
         @include('partials.footer')
        @include('partials.scripts')
    </body>
</html>