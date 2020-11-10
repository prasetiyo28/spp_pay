@extends('dashboard.layouts.app')
@section('title', 'Kelas')

@section('content')
@if($kelas->count() > 0)
<div class="row">
  <div class="col-xs-12">
    <h3 class="pull-left" style="margin-top:0px;">Kelas</h3>
  </div>
  <div class="col-md-4">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Kelas Baru</h4>
        </div>
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
      <form autocomplete="off" method="post" action="{{route('kelas.store')}}">
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Periode</label>
            <select class="form-control" style="width: 100%;" name="periode_id">
                <option value="">Pilih periode</option>
                @foreach($periode as $p)
                    <option value="{{$p->id}}">{{$p->nama}}</option>
                @endforeach
            </select>
        </div>
      <div class="form-group">
        <label>Nama Kelas</label>
        <input type="text" class="form-control" name="nama" placeholder="X IPA 1">
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
      <button type="submit" class="btn btn-danger btn-sm-bg-red">Batal</button>
    </div>
  </form>
    </div>
  </div>
  <div class="col-md-8">
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
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="kelas-table" class="table table-bordered table-striped" style="width:100%!important">
          <thead>
            <tr>
              <th width="10"></th>
              <th>Nama</th>
              <th width="100">Periode</th>
              <th width="80">Action</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
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
      <h3>Kelas masih kosong!</h3>
      <p><img src="{{ asset('assets/images/empty.png') }}" width="250" alt="Empty data"></p>
      <p><a href="{{route('kelas.create')}}" class="btn btn-secondary bg-yellow btn-xs">Buat kelas baru</a></p>
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
      $('#kelas-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('kelas.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama', name: 'nama' },
        { data: 'periode', name: 'periode' },
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