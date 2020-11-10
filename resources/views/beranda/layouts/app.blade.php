<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name', 'Ziqo Media Finance') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/material/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/material/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/material/dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="/assets/material/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/skins/all-md-skins.min.css">
  <script src="/assets/material/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/material/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    h1#judul {
      font-size: 32px;
      font-weight: bold;
     color: #ff9800;
  }

  
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-yellow-light layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand">Pembayaran<b>SPP</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ Route::currentRouteName() == 'beranda'  ? 'active' : '' }}"><a href="{{route('beranda')}}">Beranda</a></li>
            <li class="{{ Route::currentRouteName() == 'tagihan'  ? 'active' : '' }}"><a href="{{route('tagihan')}}"  >Tagihan SPP  <span id="notif"></span></a> </li>
            <li class="{{ Route::currentRouteName() == 'history'  ? 'active' : '' }}"><a href="{{route('history')}}">History Pembayaran</a></li>
          
          </ul>
         
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
                      <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/assets/material/images/user2.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ucwords(Auth::user()->nama)}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/assets/material/images/user2.png" class="img-circle" alt="User Image">

                  <p>
                    {{ucwords(Auth::user()->nama)}}
                    <small>{{ucwords(Auth::user()->email)}}</small>
                  </p>
                </li>
               
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{route('profil')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                     <a class="btn btn-default btn-flat" href="javascript:;" onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;" >{{ csrf_field() }}</form>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  @include('sweetalert::alert')
 @yield('content')
     
  <footer class="main-footer">
    <div class="container">
     <strong>Copyright &copy; {{date('Y')}} </strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->


<script src="/assets/material/dist/js/material.min.js"></script>
<script src="/assets/material/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- SlimScroll -->
<script src="/assets/material/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/material/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/material/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/material/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
        
            $.ajax({
               type:'get',
               url:'{{route('getTagihan')}}',
               success:function(data) {
                 if (data > 0) {
                  var message = '<span class="label label-danger">'+data+'</span></a>';
                  $("#notif").html(message);
                  console.log(data);
                 }
                  
               }
            });
         
      </script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@stack('footer')
</body>
</html>
