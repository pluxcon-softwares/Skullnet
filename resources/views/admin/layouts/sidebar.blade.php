<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('admin.dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>SkullNet.cc</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <!-- <div class="profile_pic">
          <img src="#" alt="..." class="img-circle profile_img">
        </div> -->
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>{{Auth::guard('admin')->user()->username}}</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
            @if(isset($mainCategories))
                @foreach($mainCategories as $category)
                <li><a href="{{route('admin.products', ['id'=>$category->id])}}"><i class="fa fa-arrow-right"></i> {{$category->category_name}}</a></li>
                @endforeach
            @endif

            <div class="divider"></div>
            <li><a><i class="fa fa-gears"></i> Prod. Categories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{route('admin.categories')}}">Main Category</a></li>
                  <li><a href="{{route('admin.subcategories')}}">Sub Category</a></li>
                </ul>
              </li>
            <div class="divider"></div>

            <!-- <li><a href="#"><i class="fa fa-credit-card"></i> Cards</a></li> -->
            <li><a href="{{route('admin.orders')}}"><i class="fa fa-shopping-cart"></i> Orders</a></li>
            <li><a href="{{route('admin.purchases')}}"><i class="fa fa-shopping-cart"></i> Purchases</a></li>
            <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{route('admin.admin-account')}}">Admins</a></li>
                  <li><a href="{{route('admin.user-account')}}">Users</a></li>
                </ul>
              </li>
            <li><a href="{{ route('admin.tickets') }}"><i class="fa fa-support"></i> Support</a></li>
            <li><a href="{{route('admin.message-board')}}"><i class="fa fa-comments"></i> Message Board</a></li>
            <!--<li><a><i class="fa fa-support"></i> Support</a>
                <ul class="nav child_menu">
                  <li><a href="#">Tickets</a></li>
                  <li><a href="#">Reports</a></li>
                </ul>
            </li>-->
            <li><a href="{{ route('admin.rules') }}"><i class="fa fa-flag"></i> Rules</a></li>
          </ul>
        </div>

      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <!--div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
          <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div> -->
      <!-- /menu footer buttons -->
    </div>
  </div>
