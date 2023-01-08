<div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="{{route('dashboard')}}"><i class="fa fa-bars" aria-hidden="true"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="{{route('dashboard')}}"><i class="fa fa-bars" aria-hidden="true"></i></a></div>
        <!-- <div class="input-group hidden-xs-down wd-170 transition">
          <input id="searchbox" type="text" class="form-control" placeholder="Buscar">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div> -->
      </div><!-- br-header-left -->

      <div class="br-header-right">
        <nav class="nav">      
          <div class="dropdown">
            <a href="table-basic.html" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down">{{ Auth::user()->name }}</span>
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
                <h6 class="logged-fullname">{{ Auth::user()->name }}</h6>
                <p>{{ Auth::user()->email }}</p>
              </div>
              
              <ul class="list-unstyled user-profile-nav">
                <li><form method="POST" action="{{ route('logout') }}"> @csrf
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit();"><i class="icon ion-power"></i> Salir</a></form></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
       
      </div><!-- br-header-right -->
    </div><!-- br-header -->