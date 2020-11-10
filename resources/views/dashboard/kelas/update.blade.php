@extends('dashboard.layouts.app')
@section('title', 'Kelas')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Update Kelas</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
 
  <form autocomplete="off" method="post" action="{{route('kelas.update', $kelas->id)}}" enctype="multipart/form-data">       
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Minimal</label>
            <select class="form-control" style="width: 100%;" name="periode_id">
                @foreach($periode as $p)
                <option value="{{ $p->id }}" {{ isset($kelas) ? ($p->id == $kelas->periode_id ? 'selected' : '') : '' }}>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
      <div class="form-group">
        <label>Nama Kelas</label>
        <input type="text" class="form-control" name="nama" value="{{$kelas->nama}}">
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
