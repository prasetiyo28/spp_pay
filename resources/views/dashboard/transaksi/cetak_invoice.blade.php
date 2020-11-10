
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/material/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/material/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/material/dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="/assets/material/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/MaterialAdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Invoice Pembayaran Administrasi
            <small class="pull-right">Date: {{date('d/m/yy')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <h5><b>Kode Pembayaran #{{$invoice->kode_transaksi}}</b></h5>
          <b>Nama Siswa :</b> {{$invoice->siswa->nama_siswa}}<br>
          <b>Kelas :</b> {{$invoice->siswa->kelas->nama}}<br>
          <b>TTL :</b> {{$invoice->siswa->tempat_lahir. ', ' . $invoice->siswa->tanggal_lahir}} <br>
          <b>Nama Wali:</b> {{$invoice->siswa->nama_wali}} <br>
          <b>Alamat:</b> {{$invoice->siswa->alamat}} <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <br>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tagihan</th>
              <th>Tanggal Pembayaran</th>
              <th>Total Pembayaran</th>
              <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>{{$invoice->tagihan->nama}}</td>
              <td>{{$invoice->tgl_transaksi}}</td>
              <td>{{$invoice->total_pembayaran}}</td>
              <td>{{$invoice->keterangan}}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>