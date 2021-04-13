<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/paper-dashboard-master/assets/img/sudipenrhulogo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('/paper-dashboard-master/assets/img/sudipenrhulogo.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('/paper-dashboard-master/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/paper-dashboard-master/assets/css/paper-dashboard.css') }}" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/c93b9e4bc6.js" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

</head>

<body class="">
  <div class="wrapper ">
@include('layouts.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
  @include('layouts.navbar')
      <!-- End Navbar -->

    @yield('content')
 
     @include('layouts.footer')
     @include('layouts.logout')
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('/paper-dashboard-master/assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/paper-dashboard-master/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/paper-dashboard-master/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/paper-dashboard-master/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Chart JS -->
  <script src="{{ asset('/paper-dashboard-master/assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/paper-dashboard-master/assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/paper-dashboard-master/assets/js/paper-dashboard.min.js') }}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('/paper-dashboard-master/assets/demo/demo.js') }}"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  @yield('js-scripts')
</body>

</html>
