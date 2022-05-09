<nav class="navbar navbar-expand-md navbar navbar-dark bg-dark ">    
    <div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
       
    </a>   
    <a class="navbar-brand" href="{{ url('/home') }}">
       
    </a> 
      
</div>

<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/home') }}"><span>IT Help Desk</span></a></h1>        
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/home') }}">Home</a></li>
          <!---<li><a class="nav-link scrollto" href="{{route ('quick.index')}}">Quick Bar</a></li>--->
          <li class="dropdown"><a href="#"><span>I.T Queries</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              
              <li><a href="{{route ('query.showQueryCategories')}}">Send an I.T Query</a></li>
              <li><a href="{{route ('query.indexPendingQueries')}}">Pending Queries</a></li>
              <li><a href="{{route ('query.indexAssignedorClearedQueries', 2)}}">Assinged Queries</a></li>
              <li><a href="{{route ('query.indexAssignedorClearedQueries', 3)}}">Cleared Queries</a></li>

              
            </ul>
          </li>         

          <!-- Authentication Links -->
          @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    
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
</nav>
