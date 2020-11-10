@extends('dashboard.layouts.app')
@section('title', 'Transaksi')

@section('content')
<div class="row">
  <div class="col-xs-12">
    <h3 class="pull-left" style="margin-top:0px;">@yield('title')</h3>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <form action="{{route('transaksi.cari')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-3" style="margin-top:0px;">
              <div class="form-group" style="margin-top:0px;">
                <input type="text" class="form-control" name="kode_pembayaran" placeholder="Kode tagihan" style="margin-top:0px;">
              </div>
            </div>
              <button type="submit" class="btn btn-succcess bg-green btn-sm"><i class="fa fa-search"></i> Cari</button>
          </div>
        </form>
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
        <table id="transaksi_table" class="table table-bordered table-striped" style="width:100%!important">
           <thead>
            <tr>
              <th width="10"></th>
              <th>Kode Transaksi</th>
              <th>Nama Siswa</th>
              <th>Tagihan</th>
              <th>Tanggal Transaksi</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th width="80">Action</th>
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
      $('#transaksi_table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: '{!! route('transaksi.getdata') !!}',
        columns: [
          { data: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'kode_transaksi', name: 'kode_transaksi' },
          { data: 'nama_siswa', name: 'nama_siswa' },
          { data: 'tagihan', name: 'tagihan' },
          { data: 'tgl_transaksi', name: 'tgl_transaksi' },
          { data: 'jumlah', name: 'jumlah' },
          { data: 'keterangan', name: 'keterangan' },
          { data: 'action', name: 'action' }
        ]
      });
    });
  </script>

@endpush








  