<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">

          <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user-secret"></i><img src="images/img.jpg" alt="">{{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="{{ route('profile') }}"> Profile</a>
                <a class="dropdown-item"  href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </div>
          </li>

          <li class="nav-item" style="padding-left: 15px;">Wallet: (${{ Auth::user()->wallet ? Auth::user()->wallet : '0.00' }})</li>

          <li role="presentation" class="nav-item dropdown open" style="margin-left: 15px;">
            <a href="{{route('tickets')}}" class="dropdown-toggle info-number" id="navbarDropdown1">
            <i class="fa fa-comment"></i>
              <span class="badge bg-danger" style="color: #ffffff;">{{ $ticketReplyNotifications ? $ticketReplyNotifications : '0' }}</span>
            </a>
          </li>

          <li role="presentation" class="nav-item dropdown open">
            <a href="{{route('cart')}}" class="dropdown-toggle info-number" id="navbarDropdown1">
            <i class="fa fa-shopping-cart" id="countOrderItems"></i>
              <span class="badge bg-green">0</span>
            </a>
          </li>

        </ul>
      </nav>
    </div>
</div>
  <!-- /top navigation -->
