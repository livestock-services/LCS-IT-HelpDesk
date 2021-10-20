<nav class="navbar navbar-expand-md navbar navbar-dark bg-dark ">    <div class="container">
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
                    <a class="dropdown-item" href="{{route ('query.create')}}">Send an I.T Query<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="">View past I.T Query<span class="sr-only">(current)</span></a>                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Queries Mangament<span class="sr-only">(current)</span></a>
                <div class="dropdown-menu">                                              
                    <a class="dropdown-item" href="{{route ('category.create')}}">Create Query Category<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="">View Query Category<span class="sr-only">(current)</span></a>                    
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
