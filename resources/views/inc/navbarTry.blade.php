
<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
      
    <div class="container d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'IT Help Desk') }} 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- Left Side Of Navbar -->
            <!--<ul class="navbar-nav mr-auto">
                <li><a href="/">Home </a></li>
                <li><a href="/about">About </a></li>
                <li><a href="/services">Services </a></li>
                <li><a href="/posts">Blog </a></li>
            </ul>-->

            <ul class="nav navbar-mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">I.T Queries<span class="sr-only">(current)</span></a>
                    <div class="dropdown-menu">                                              
                        <a class="dropdown-item" href="{{route ('query.showQueryCategories')}}">Send an I.T Query<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="{{route ('query.indexPendingQueries')}}">Pending Queries<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="{{route ('query.indexAssignedorClearedQueries', 2)}}">Assinged Queries<span class="sr-only">(current)</span></a>
                        <a class="dropdown-item" href="{{route ('query.indexAssignedorClearedQueries', 3)}}">Cleared Queries<span class="sr-only">(current)</span></a>

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
                    
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="getstarted scrollto dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                   

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
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
