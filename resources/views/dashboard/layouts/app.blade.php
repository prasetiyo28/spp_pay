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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/material/dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@stack('header')
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">P<b>S</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Pembayaran<b>SPP</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/assets/material/images/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ucwords(Auth::user()->nama)}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/assets/material/images/user.png" class="img-circle" alt="User Image">

                <p>
                  {{ucwords(Auth::user()->nama)}} - {{ucwords(Auth::user()->role)}}
                  <small>{{ucwords(Auth::user()->email)}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('dashboard.profile')}}" class="btn btn-default btn-flat">Profile</a>
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
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="background-image: url(/assets/material/images/background-2.jpg);">
        <div class="pull-left image">
          <img src="/assets/material/images/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ucwords(Auth::user()->nama)}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(auth()->user()->role == 'admin')
        <li class="{{ Route::currentRouteName() == 'dashboard'  ? 'active' : '' }}">
          <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'periode.index' || Route::currentRouteName() == 'periode.edit' || Route::currentRouteName() == 'periode.create' ? 'active' : ''}}">
          <a href="{{route('periode.index')}}">
            <i class="fa fa-refresh"></i> <span>Tahun Ajaran</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'kelas.index' || Route::currentRouteName() == 'kelas.edit' ||Route::currentRouteName() == 'kelas.create'  ? 'active' : '' }}">
          <a href="{{route('kelas.index')}}">
            <i class="fa fa-cube"></i> <span>Kelas</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'wali-kelas.index' || Route::currentRouteName() == 'kwali-kelaselas.edit' ||Route::currentRouteName() == 'wali-kelas.create'  ? 'active' : '' }}">
          <a href="{{route('wali-kelas.index')}}">
            <i class="fa fa-cube"></i> <span>Wali Kelas</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'siswa.index' || Route::currentRouteName() == 'siswa.edit' || Route::currentRouteName() == 'siswa.create' ? 'active' : '' }}">
          <a href="{{route('siswa.index')}}">
            <i class="fa fa-users"></i> <span>Siswa</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'tagihan.index' || Route::currentRouteName() == 'tagihan.edit' || Route::currentRouteName() == 'tagihan.create' ? 'active' : '' }}">
          <a href="{{route('tagihan.index')}}">
            <i class="fa fa-list-alt"></i> <span>Tagihan</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'transaksi.index' || Route::currentRouteName() == 'transaksi.edit' || Route::currentRouteName() == 'transaksi.create' ? 'active' : ''}}">
          <a href="{{route('transaksi.index')}}">
            <i class="fa fa-exchange"></i> <span>Transaksi SPP</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('lap.tunggakan')}}"><i class="fa fa-circle-o"></i> Laporan Tunggakan</a></li>
            <li><a href="{{route('lap.pembayaran')}}"><i class="fa fa-circle-o"></i> Laporan Pembayaran</a></li>
          </ul>
        </li>
        @elseif(auth()->user()->role == 'superadmin')
        <li class="{{ Route::currentRouteName() == 'kepsek.dashboard'  ? 'active' : '' }}">
          <a href="{{route('kepsek.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        </li>
        <li class="{{ Route::currentRouteName() == 'kepsek.siswa' ||Route::currentRouteName() == 'kepsek.siswa'  ? 'active' : '' }}">
          <a href="{{route('kepsek.siswa')}}">
            <i class="fa fa-users"></i> <span>Siswa</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview {{ Route::currentRouteName() == 'kepsek.tagihan' ||Route::currentRouteName() == 'kepsek.tagihan' ||Route::currentRouteName() == 'kepsek.transaksi' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Route::currentRouteName() == 'kepsek.tagihan'  ? 'active' : '' }}">
              <a href="{{route('kepsek.tagihan')}}"><i class="fa fa-circle-o"></i> Laporan Tagihan</a>
            </li>
            <li class="">
              <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Tuggakan</a> -->
            </li>
            <li class="{{ Route::currentRouteName() == 'kepsek.transaksi'  ? 'active' : '' }}">
              <a href="{{route('kepsek.transaksi')}}"><i class="fa fa-circle-o"></i>Laporan Transaksi</a>
            </li>
          </ul>
        </li>
        @elseif(auth()->user()->role == 'walikelas')
        <li class="{{ Route::currentRouteName() == 'dashboard'  ? 'active' : '' }}">
          <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'kepsek.siswa' ||Route::currentRouteName() == 'kepsek.siswa'  ? 'active' : '' }}">
          <a href="{{route('kepsek.siswa')}}">
            <i class="fa fa-users"></i> <span>Siswa</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'tagihan.tagihan-kelas' ? 'active' : '' }}">
          <a href="{{route('tagihan.tagihan-kelas')}}">
            <i class="fa fa-list-alt"></i> <span>Tagihan</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
     @yield('content')
     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} </strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/assets/material/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/material/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="/assets/material/dist/js/material.min.js"></script>
<script src="/assets/material/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- DataTables -->

<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/material/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/material/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/material/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/material/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });



</script>

@stack('footer')
</body>
</html>
