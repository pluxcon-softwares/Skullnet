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
              <i class="fa fa-user-secret"></i><img src="images/img.jpg" alt="">{{ Auth::guard('admin')->user()->username }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </div>
          </li>

          <li role="presentation" class="nav-item dropdown open">
            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-comments"></i>
              <span class="badge bg-red">
                  {{ $ticketNotifications ? count($ticketNotifications) : '0'}}
              </span>
            </a>
            @if (isset($ticketNotifications))
            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                @foreach ($ticketNotifications as $notification)
                <li class="nav-item">
                    <span class="message">
                    <a href="{{route('admin.tickets')}}">{{ $notification->subject }}</a>
                    </span>
                </li>
                @endforeach
            </ul>
            @endif
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->
