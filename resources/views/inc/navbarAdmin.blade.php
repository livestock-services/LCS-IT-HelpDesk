<nav class="navbar navbar-light bg-light" id="navbar">    
    <div class="container">
    <a class="navbar-brand" href="">   
    </a> 
    <a class="navbar-brand" href="">    
    </a>   
</div>

 
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-bold" style="font-weight: Nunito, sans-serif;"><a href="{{  route('admin.home') }}"><span>IT Help Desk</span></a></h1>

        <!---<a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'LSC-IT-Help-Desk') }} <span>&#xe081</span>
        </a>--->
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <!---<nav id="navbar" class="navbar">--->
        <ul>
          <li><a class="nav-link scrollto active" href="{{ route('admin.home') }}">Home</a></li>
          <!---<li><a class="nav-link scrollto" href="{{route ('quick.index')}}">Quick Bar</a></li>--->
          @role('Super Admin')
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
              <!--<li><a href="{{route ('query.showQueryCategories')}}">Send an I.T Query</a></li>--->
              <li><a href="{{route ('newQueriesAdmin.index')}}">New I.T Queries</a></li>
              <li><a href="{{route ('assignedQueries.index')}}">Assinged I.T Queries</a></li>              
              <li><a href="{{route ('clearedQueriesAdmin.index')}}">All Cleared I.T Queries</a></li>
              <!---<li><a href="">I.T Query Analytics</a></li>--->
              
            </ul>
          </li>
          @endrole
          <li class="dropdown"><a href="#"><span>Your Queries</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route ('assignedQueries.indexYourAssignedOrClearedQueries',2)}}">Pending I.T Queries</a></li>
              <li><a href="{{route ('assignedQueries.indexYourAssignedOrClearedQueries',3)}}">Cleared I.T Queries</a></li>
              
            </ul>
          </li>          
          <li class="dropdown"><a href="#"><span>User Management</span> <i class="bi bi-chevron-down"></i></a>
            <ul>              
              <!---<li class="dropdown"><a href="#"><span>User Roles</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{route ('userRole.create')}}">Create Role</a></li>
                  <li><a href="{{route ('userRole.index')}}">View Roles</a></li>                  
                </ul>
              </li>--->
              <li class="dropdown"><a href="#"><span>Staff</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('register') }}">Add Staff User</a></li>              
                  <li><a href="{{ route('userManagement.index')}}">View Staff Users</a></li>                  
                </ul>
              </li>
              @role('Super Admin')
              <li class="dropdown"><a href="#"><span>Admin</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('adminManagement.register') }}">Add Admin</a></li>
                  <li><a href="{{ route('adminManagement.index') }}">View Admins</a></li>
                </ul>
              </li>  
              @endrole            
            </ul>
          </li>
          @role('Super Admin')
          <li class="dropdown"><a href="#"><span>Query Management</span> <i class="bi bi-chevron-down"></i></a>
            <ul>              
              <li><a href="{{route ('category.create')}}">Create Query Category</a></li>
              <li><a href="{{route ('category.index')}}">View Query Categories</a></li> 
              <li><a href="{{route ('adminQueries.reports')}}">Query Reports</a></li>            
            </ul>
          </li>
          @endrole
          
          
          <!--<li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
         
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>--->
          

          <!-- Authentication Links -->
          @if(Auth::guard('admin')->check())
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="getstarted scrollto dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="councilDropdown">
                    <a class="dropdown-item" href="{{route ('adminChangePassword.edit')}}">Reset Password<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#council-logout-form').submit();">
                        Logout
                    </a>
                    <form id="council-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      <!---</nav><!-- .navbar -->

    </div>
  </header>
</nav>
