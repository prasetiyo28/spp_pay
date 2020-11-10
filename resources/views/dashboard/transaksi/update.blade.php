@extends('dashboard.layouts.app')
@section('title', 'Transaksi')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Update Transaksi</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
 
  <form autocomplete="off" method="post" action="{{route('transaksi.update', $transaksi->id)}}" enctype="multipart/form-data">       
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Nama Siswa</label>
            <select class="form-control" style="width: 100%;" name="siswa_id">
                @foreach($siswa as $s)
                <option value="{{ $s->id }}" {{ isset($transaksi) ? ($s->id == $transaksi->siswa_id ? 'selected' : '') : '' }}>{{ $s->nama_siswa }} - {{ isset($s->kelas) ? $s->kelas->nama : '' }}</option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
            <label>Tagihan</label>
            <select class="form-control" style="width: 100%;" name="tagihan_id">
                @foreach($tagihan as $t)
                <option value="{{ $t->id }}" {{ isset($transaksi) ? ($t->id == $transaksi->tagihan_id ? 'selected' : '') : '' }}>{{ $t->nama}} - {{ isset($transaksi) ? $t->jumlah : '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Transaksi</label>
              <input type="text" class="form-control datepicker" id="tgltransaksi" name="tgl_transaksi" value="{{$transaksi->tgl_transaksi}}">
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" value="{{$transaksi->keterangan}}">
        </div>
        </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
        <a type="javascript:;" data-toggle="modal" class="btn btn-danger btn-sm-bg-red" data-target="#konfirmasi_batal" data-href="{{route('kelas.index')}}" title="Delete"> Batal</a>
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

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
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
