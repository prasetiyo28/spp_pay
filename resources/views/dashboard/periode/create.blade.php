@extends('dashboard.layouts.app')
@section('title', 'Periode')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">New Periode</h3>
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
  <form autocomplete="off" method="post" action="{{route('periode.store')}}">
    @csrf
    <div class="box-body">
      <div class="form-group">
        <label>Nama Periode</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama">
      </div>
      <div class="form-group">
        <label>Tanggal Masuk s/d Selesai</label>
        <div class="row">
          <div class="col-sm-6">
            <input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl_mulai" placeholder="dd/mm/yyyy">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control datepicker" name="tgl_selesai" id="tgl_selesai" placeholder="dd/mm/yyyy">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Tahun</label>
        <input type="text" class="form-control" name="tahun" placeholder="2020">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="is_active" value="1"> Aktif
        </label>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
      <button type="submit" class="btn btn-danger btn-sm-bg-red">Batal</button>
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
   $("#tgl_mulai").on('changeDate', function(selected) {
    var startDate = new Date(selected.date.valueOf());
    $("#tgl_selesai").datepicker('setStartDate', startDate);
    if($("#tgl_mulai").val() > $("#tgl_selesai").val()){
      $("#tgl_selesai").val($("#tgl_mulai").val());
    }
  });
 });
</script>
@endpush
