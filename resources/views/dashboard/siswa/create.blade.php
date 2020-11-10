@extends('dashboard.layouts.app')
@section('title', 'Siswa')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Siswa Baru</h3>
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
  <form autocomplete="off" method="post" action="{{route('siswa.store')}}">
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label>Pilih Kelas</label>
            <select class="form-control" style="width: 100%;" name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                  <option value="{{$k->id}}">{{$k->nama}} - {{$k->periode->nama}}</option>
                @endforeach
            </select>
        </div>
      <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama Siswa">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email Siswa">
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" placeholder="dd/mm/yyyy">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" style="width: 100%;" name="jenis_kelamin">
            <option value="">Jenis Kelamin</option>
            <option value="L"{{(old('jenis_kelamin') == 'L') ? ' selected' : ''}}>Laki-laki</option>
            <option value="P"{{(old('jenis_kelamin') == 'P') ? ' selected' : ''}}>Perempuan</option>
        </select>
      </div>
      <div class="form-group is-empty">
        <label>Alamat</label>
          <textarea class="form-control" rows="3" placeholder="Alamat" name="alamat"></textarea>
      </div>
       <div class="form-group">
        <label>Nama Wali</label>
        <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali">
      </div>
      <input type="text" name="role" placeholder="Nama Wali" value="siswa" hidden="true">
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
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_batal').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>
  <script type="text/javascript"> 
    $(function() {
      $('#periode-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('siswa.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama', name: 'nama' },
        { data: 'tgl_mulai', name: 'tgl_mulai' },
        { data: 'tgl_selesai', name: 'tgl_selesai' },
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action' }
        ] 
      });
    });
  </script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
 $(function(){
   $("#tanggal_lahir").datepicker({
    format: 'yy/mm/dd',
    autoclose: true,
    todayHighlight: true,
  });
  });
</script>
@endpush
