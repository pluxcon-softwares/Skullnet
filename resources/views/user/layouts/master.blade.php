
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>SkullNet @if(isset($title)) {{ $title }} @endif </title>

    <!-- Bootstrap -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress.css')}}" rel="stylesheet">

    <!-- DataTabless -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Animate -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sg-style.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        @include('user.layouts.sidebar')

        @include('user.layouts.header')

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('user.layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('js/moment.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('js/custom.min.js')}}"></script>

    <script>
        $(function(){
            function countOrderItems(){
                $.ajax({
                    url: '/cart/count/orderItems',
                    method: 'GET',
                    success: function(res){
                        $("#countOrderItems").siblings().remove();
                        $(`<span class="badge bg-green">${res.countOrderItems ? res.countOrderItems : '0'}</span>`).insertAfter($("#countOrderItems"));
                    }
                });
            }
            countOrderItems();
        });
    </script>

    @yield('extra_script')

  </body>
</html>
