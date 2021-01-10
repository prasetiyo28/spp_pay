@extends('dashboard.layouts.app')
@section('title', 'Wali Kelas')

@section('content')
@if($waliKelas->count() > 0)
<div class="row">
  <div class="col-xs-12">
    <h3 class="pull-left" style="margin-top:0px;">Wali Kelas</h3>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a href="{{route('wali-kelas.create')}}" class="btn btn-secondary bg-green btn-sm pull-left"><i class="fa fa-plus" aria-hidden="true"></i> New Wali Kelas</a>
        <!-- <button type="button" class="btn btn-success btn-sm bg-green pull-left" data-toggle="modal" data-target="#import"> <span class="fa fa-upload"> </span> Import</button>
        <button id="export" class="pull-left mb-5 btn btn-secondary btn-sm bg-green"><span class="fa fa-download"> Export</span></button>
        <div class="form-group pull-left" style="margin-top:0px;">
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
        <table id="tagihan-table" class="table table-bordered table-striped" style="width:100%!important">
           <thead>
            <tr>
              <th width="10"></th>
              <th>Kelas</th>
              <th>Nama</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
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
@else
<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="text-center">
      <h3>Tagihan belum ada!</h3>
      <p><img src="{{ asset('assets/images/empty.png') }}" width="250" alt="Empty data"></p>
      <p><a href="{{route('wali-kelas.create')}}" class="btn btn-secondary bg-yellow btn-xs">Tambah tagihan baru</a></p>
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
      $('#tagihan-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('wali-kelas.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'kelas', name: 'kelas' },
        { data: 'nama_wali_kelas', name: 'nama_wali_kelas' },
        { data: 'tempat_lahir', name: 'tempat_lahir' },
        { data: 'tanggal_lahir', name: 'tanggal_lahir' },
        { data: 'jenis_kelamin', name: 'jenis_kelamin' },
        { data: 'alamat', name: 'alamat' },
        { data: 'action', name: 'action' }
        ]
      });
    });
  </script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
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








