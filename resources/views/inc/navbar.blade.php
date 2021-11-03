<nav class="navbar navbar-expand-md navbar navbar-dark bg-dark ">    
    <div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        {{ config('app.name', 'LSC-IT-Help-Desk') }} <span>&#xe081</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">I.T Queries<span class="sr-only">(current)</span></a>
                <div class="dropdown-menu">                                              
                    <a class="dropdown-item" href="{{route ('query.showQueryCategories')}}">Sendss an I.T Query<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="">View past I.T Query<span class="sr-only">(current)</span></a>                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Queries Mangament<span class="sr-only">(current)</span></a>
                <div class="dropdown-menu">                                              
                    <a class="dropdown-item" href="{{route ('category.create')}}">Create Query Category<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="{{route ('category.index')}}">View Query Category<span class="sr-only">(current)</span></a>                    
                </div>
            </li>
                       
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                   

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">Edit Account<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>
</nav>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/home') }}"><span>IT Help Desk</span></a></h1>

        <!---<a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'LSC-IT-Help-Desk') }} <span>&#xe081</span>
        </a>--->
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/home') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route ('quick.index')}}">Quick Bar</a></li>
          <li class="dropdown"><a href="#"><span>I.T Queries</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!---<li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{route ('query.create')}}">Send an I.T Query</a></li>
                  <li><a href="#">View past I.T Query</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>                  
                </ul>
              </li>--->
              <li><a href="{{route ('query.showQueryCategories')}}">Send an I.T Query</a></li>
              <li><a href="#">View past I.T Query</a></li>
              <!--<li><a href="#">Drop Down 2</a></li>              
              <li><a href="#">Drop Down 4</a></li>--->
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Query Mangament</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!---<li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{route ('query.create')}}">Send an I.T Query</a></li>
                  <li><a href="#">View past I.T Query</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>--->
              <li><a href="{{route ('category.create')}}">Create Query Category</a></li>
              <li><a href="{{route ('category.index')}}">View Query Categories</a></li>
              <!--<li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>--->
            </ul>
          </li>
          
          
          <!--<li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
         
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>--->
          

          <!-- Authentication Links -->
          @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="getstarted scrollto dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                   

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">Edit Account<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
