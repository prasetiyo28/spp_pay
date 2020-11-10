@extends('dashboard.layouts.app')
@section('title', 'Transaksi')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Transaksi Baru</h3>
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
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Nama Siswa</label>
            <select class="form-control" style="width: 100%;" name="siswa_id">
                <option value="">Pilih Siswa</option>
                @foreach($siswa as $s)
                    <option value="{{$s->id}}">{{$s->nama_siswa}} - {{$s->kelas->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tagihan</label>
            <select class="form-control" style="width: 100%;" name="tagihan_id">
                <option value="">Pilih Tagihan</option>
                @foreach($tagihan as $t)
                    <option value="{{$t->id}}">{{$t->nama}} - {{$t->jumlah}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Transaksi</label>
              <input type="text" class="form-control datepicker" id="tgltransaksi" name="tgl_transaksi">
        </div>
      <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Pembayaran">
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


