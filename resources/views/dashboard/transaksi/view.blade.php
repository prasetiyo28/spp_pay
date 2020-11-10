@extends('dashboard.layouts.app')
@section('title', 'Pembayaran Tagihan')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Transaksi</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form autocomplete="off" method="post" action="{{route('transaksi.store')}}">
  {{ csrf_field() }}
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label>Kode Transaksi</label>
              <input type="text" class="form-control" name="kode_transaksi" placeholder="Nama Siswa" value="{{$tagihan->kode_tagihan}}" readonly="true">
          </div>
          <div class="form-group">
              <label>Nama Siswa</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="{{$tagihan->getSiswa->nama_siswa}}" readonly="true">
              <input type="text" name="siswa_id" placeholder="Nama Siswa" value="{{$tagihan->getSiswa->id}}" hidden="true">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Kelas</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="{{$tagihan->getKelas->nama}}" readonly="true">
          </div>
        </div>
      </div>
      <div class="form-group">
          <label>Tagihan</label>
          <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="{{$tagihan->getTagihan->nama}}" readonly="true">
          <input type="text" name="tagihan_id" placeholder="Nama Siswa" value="{{$tagihan->getTagihan->id}}" hidden="true">
      </div>

      <div class="form-group">
        <label>Total Tagihan</label>
        <p>IDR. {{$tagihan->getTagihan->jumlah}}</p>
          <!-- <input type="text" class="form-control datepicker" id="tgltransaksi" name="tgl_transaksi" value="{{$tagihan->getTagihan->jumlah}}"> -->
      </div>
      <div class="form-group" style="margin-top:0px;">
        <label>Total Pembayaran</label>
          <input type="text" class="form-control" name="total_pembayaran">
      </div>
      <div class="form-group" style="margin-top:0px;">
        <label>Tanggal Pembayaran</label>
          <input type="text" class="form-control datepicker" id="tgltransaksi" name="tgl_transaksi">
      </div>
      <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"></textarea>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
     <a type="javascript:;" data-toggle="modal" class="btn btn-danger btn-sm-bg-red" data-target="#konfirmasi_batal" data-href="{{route('transaksi.index')}}" title="Delete"> Batal</a>
     
    </div>
  </form>
</div>

<div class="modal fade" id="konfirmasi_batal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-body">
     <b>Anda yakin ingin membatalkan proses ini ?</b><br><br>
     <a class="btn btn-danger btn-ok">Ya</a>
     <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
   </div>
 </div>
</div>
</div>
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


