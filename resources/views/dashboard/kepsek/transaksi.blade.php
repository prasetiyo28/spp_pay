@extends('dashboard.layouts.app')
@section('title', 'Laporan Transaksi')

@section('content')
@if($transaksi->count() > 0 )
<div class="row">
  <div class="col-xs-12">
    <h3 class="pull-left" style="margin-top:0px;">Transaksi</h3>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <!-- <a href="{{route('transaksi.create')}}" class="btn btn-secondary bg-green btn-sm pull-left"><i class="fa fa-plus" aria-hidden="true"></i> New Tagihan</a>
        <button type="button" class="btn btn-success btn-sm bg-green pull-left" data-toggle="modal" data-target="#import"> <span class="fa fa-upload"> </span> Import</button> -->
        <a href="{{route('export.transaksi')}}" class="pull-left mb-5 btn btn-secondary btn-sm bg-green"><i class="fa fa-download" aria-hidden="true"></i> Export</a>       <!--  <div class="form-group pull-left" style="margin-top:0px;">
          <div class="btn btn-success btn-sm bg-green">
            <div id="reportrange">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
    <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
      @endif
      @if ($message = Session::get('message'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
      @endif
      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
      @endif
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="transaksi_laporan" class="table table-bordered table-striped" style="width:100%!important">
           <thead>
            <tr>
              <th width="10"></th>
              <th>Kode Transaksi</th>
              <th>Nama Siswa</th>
              <th>Tagihan</th>
              <th>Tanggal Transaksi</th>
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
  <!-- /.col -->
</div>
@else
<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="text-center">
      <h3>Tagihan belum ada!</h3>
      <p><img src="{{ asset('assets/images/empty.png') }}" width="250" alt="Empty data"></p>
      <p><a href="{{route('transaksi.create')}}" class="btn btn-secondary bg-yellow btn-xs">Tambah transaksi baru</a></p>
    </div>
  </div>
</div>
@endif
<!-- /.row -->

<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-body">
     <b>Anda yakin ingin menghapus Permanen data ini ?</b><br><br>
     <a class="btn btn-danger btn-ok"> Hapus</a>
     <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
   </div>
 </div>
</div>
</div>
@endsection


@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>
  <script type="text/javascript"> 
    $(function() {
      $('#transaksi_laporan').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('transaksi.getdata.laporan') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'kode_transaksi', name: 'kode_transaksi' },
        { data: 'nama_siswa', name: 'nama_siswa' },
        { data: 'tagihan', name: 'tagihan' },
        { data: 'tgl_transaksi', name: 'tgl_transaksi' },
        { data: 'jumlah', name: 'jumlah' },
        { data: 'keterangan', name: 'keterangan' },
        ]
      });
    });
  </script>

@endpush








  