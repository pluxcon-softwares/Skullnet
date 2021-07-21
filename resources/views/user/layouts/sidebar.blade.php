<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('home')}}" class="site_title"><i class="fa fa-paw"></i> <span>SkullNet.CC</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>@if(isset(Auth::user()->username)) {{ Auth::user()->username }} @endif</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
            @if (isset($mainCategories))
                @foreach ($mainCategories as $category)
                <li><a href="{{route('products', ['id' => $category->id])}}"><i class="fa fa-arrow-right"></i> {{$category->category_name}}</a></li>
                @endforeach
            @endif


            <li><a href="{{ route('purchases') }}"><i class="fa fa-shopping-cart"></i> My Purchases</a></li>
            <li><a href="{{ route('add.money') }}"><i class="fa fa-bank"></i> Add Money</a></li>
            <li><a href="{{ route('tickets') }}"><i class="fa fa-support"></i> Support</a></li>
            <li><a href="{{route('rules')}}"><i class="fa fa-flag"></i> Rules</a></li>
            <!--<li><a href="#"><i class="fa fa-credit-card"></i> Cards</a></li>-->
          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <div class="sidebar-footer hidden-small">
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
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>
