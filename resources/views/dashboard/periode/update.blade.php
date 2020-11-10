@extends('dashboard.layouts.app')
@section('title', 'Periode')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Update Periode</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
 
  <form autocomplete="off" method="post" action="{{route('periode.update', $periode->id)}}" enctype="multipart/form-data">       
    @csrf
    <div class="box-body">
      <div class="form-group">
        <label>Nama Periode</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$periode->nama}}">
      </div>
      <div class="form-group">
        <label>Tanggal Masuk s/d Selesai</label>
        <div class="row">
          <div class="col-sm-6">
            <input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl_mulai" placeholder="dd/mm/yyyy" value="{{$periode->tgl_mulai}}">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control datepicker" name="tgl_selesai" id="tgl_selesai" placeholder="dd/mm/yyyy" value="{{$periode->tgl_selesai}}">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Tahun</label>
        <input type="text" class="form-control" name="tahun" placeholder="Tahun" value="{{$periode->tahun}}">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="is_active" value="{{$periode->is_active}}"> Aktif
        </label>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
        <a type="javascript:;" data-toggle="modal" class="btn btn-danger btn-sm-bg-red" data-target="#konfirmasi_batal" data-href="{{route('periode.index')}}" title="Delete"> Batal</a>
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
