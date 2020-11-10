@extends('dashboard.layouts.app')
@section('title', 'Siswa')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Update Siswa</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
 
  <form autocomplete="off" method="post" action="{{route('siswa.update', $siswa->id)}}" enctype="multipart/form-data">       
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Pilih Kelas</label>
            <select class="form-control" style="width: 100%;" name="kelas_id">
               @foreach($kelas as $item)
                <option value="{{ $item->id }}" {{ isset($siswa) ? ($item->id == $siswa->kelas_id ? 'selected' : '') : '' }}>{{ $item->nama }} - {{ isset($item->periode) ? $item->periode->nama : '' }}</option>
              @endforeach
            </select>
        </div>
      <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" class="form-control" name="nama_siswa" value="{{$siswa->nama_siswa}}">
      </div>
      <div class="form-group">
        <label>Tempat Lahir</label>
        <input type="text" class="form-control" name="tempat_lahir" value="{{$siswa->tempat_lahir}}">
      </div>
      <div class="row">
          <div class="col-sm-6">
            <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="{{$siswa->tanggal_lahir}}">
          </div>
         
        </div>

      <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" style="width: 100%;" name="jenis_kelamin">
            <option value="L" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'L' ? 'selected' : '') : '' }}>Laki - Laki</option>
             <option value="P" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'P' ? 'selected' : '') : '' }}>Perempuan</option>
        </select>
      </div>
      <div class="form-group is-empty">
        <label>Alamat</label>
          <textarea class="form-control" rows="3"  name="alamat" value="{{$siswa->alamat}}">{{ isset($siswa) ? $siswa->alamat : old('alamat') }}</textarea>
      </div>
       <div class="form-group">
        <label>Nama Wali</label>
        <input type="text" class="form-control" name="nama_wali" value="{{$siswa->nama_wali}}">
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
        <a type="javascript:;" data-toggle="modal" class="btn btn-danger btn-sm-bg-red" data-target="#konfirmasi_batal" data-href="{{route('siswa.index')}}" title="Delete"> Batal</a>
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
   $("#tanggal_lahir").datepicker({
    format: 'yy/mm/dd',
    autoclose: true,
    todayHighlight: true,
  });
  });
</script>
@endpush
