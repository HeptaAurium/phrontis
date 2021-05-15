 <nav class="navbar navbar-expand w-100 navbar-light rounded bg-white shadow-sm top-nav">
     <div class="container d-flex align-items-center">
         <button class="btn bg-transparent d-md-none btn-toggle-sidenav" type="button" title="Show side navigation" data-toggle="tooltip">
             <i class="fa fa-bars" aria-hidden="true"></i>
         </button>

         <a class="navbar-brand logo d-flex flex-row align-items-center" href="{{ url('/') }}">
             <img src="{{ asset('img/logo/phrontis.png') }}" class="w-auto img-fluid mr-3" alt="">
             <span class="d-none d-lg-block logo-text">{{ config('app.name', 'Laravel') }}</span>
         </a>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- Left Side Of Navbar -->
             <ul class="navbar-nav mr-auto">

             </ul>

             <!-- Right Side Of Navbar -->
             <ul class="navbar-nav ml-auto">
                 <!-- Authentication Links -->
                 @guest
                     @if (Route::has('login'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                         </li>
                     @endif

                     @if (Route::has('register'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                         </li>
                     @endif
                 @else
                     <li class="nav-item dropdown">
                         <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             {{ Auth::user()->name }}
                         </a>

                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                         </div>
                     </li>
                 @endguest
             </ul>
         </div>
     </div>
 </nav>
