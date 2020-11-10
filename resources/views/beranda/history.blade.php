@extends('beranda.layouts.app')
@section('title', 'Beranda')

@section('content')
<div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <center> <h1 id="judul">HISTORY PEMBAYARAN</h1></center>
      <!--   <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> -->
      </section>

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="hitory-table" class="table table-hover">
              <thead>
                <tr>
                  <th width="10"></th>
                  <th>Kode Transaksi</th>
                  <th>Nama Siswa</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


 </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->


@endsection
@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript"> 
    $(function() {
      $('#hitory-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('tagihan.beranda.history') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'kode_tagihan', name: 'kode_tagihan' },
        { data: 'nama_tagihan', name: 'nama_tagihan' },
        { data: 'jumlah', name: 'jumlah' },
        { data: 'keterangan', name: 'keterangan' }
        ]
      });
    });
  </script>

@endpush