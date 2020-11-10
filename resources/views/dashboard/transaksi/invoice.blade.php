@extends('dashboard.layouts.app')
@section('title', 'Pembayaran Tagihan')

@section('content')
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{route('transaksi.print',$invoice->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_batal').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });


  $(function(){
   $(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
  });
 });
</script>
@endpush


