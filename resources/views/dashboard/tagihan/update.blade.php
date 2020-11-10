@extends('dashboard.layouts.app')
@section('title', 'Tagihan')

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Update Baru</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form autocomplete="off" method="post" action="{{route('tagihan.update', $tagihan->id)}}" enctype="multipart/form-data">    
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="box-body">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" value="{{$tagihan->nama}}">
      </div>
      <div class="form-group">
        <label>Jumlah</label>
        <input type="number" class="form-control" name="jumlah" value="{{$tagihan->jumlah}}">
      </div>
      <div class="form-group">
        <label for="seeAnotherField" >Peserta</label>
        <select class="form-control" id="seeAnotherField" name="peserta">
              <option value="semua siswa" >Semua Siswa</option>
              <!-- <option value="2">Hanya Kelas</option>
              <option value="3">Hanya Siswa</option> -->
        </select>
      </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" class="form-control" name="keterangan" value="{{$tagihan->keterangan}}">
      </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
     <a type="javascript:;" data-toggle="modal" class="btn btn-danger btn-sm-bg-red" data-target="#konfirmasi_batal" data-href="{{route('tagihan.index')}}" title="Delete"> Batal</a>
     
    </div>
  </form>
</div>
@endsection

@push('footer')
<link rel="stylesheet" href="/assets/material/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_batal').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
  </script>

<script>
    $("#seeAnotherField").change(function() {
  if ($(this).val() == "2") {
    $('#kelasFieldDiv').show();
    $('#kelasField').attr('required', '');
    $('#kelasField').attr('data-error', 'This field is required.');
    $('#siswaFieldDiv').hide();
    $('#siswaField').removeAttr('required');
    $('#siswaField').removeAttr('data-error');
  } else if ($(this).val() == "3") {
    $('#siswaFieldDiv').show();
    $('#siswaField').attr('required', '');
    $('#siswaField').attr('data-error', 'This field is required.');
    $('#kelasFieldDiv').hide();
    $('#kelasField').removeAttr('required');
    $('#kelasField').removeAttr('data-error');
  } else {
    $('#kelasFieldDiv').hide();
    $('#kelasField').removeAttr('required');
    $('#kelasField').removeAttr('data-error');
    $('#siswaFieldDiv').hide();
    $('#siswaField').removeAttr('required');
    $('#siswaField').removeAttr('data-error');
  }
});
$("#seeAnotherField").trigger("change");
</script>

@endpush