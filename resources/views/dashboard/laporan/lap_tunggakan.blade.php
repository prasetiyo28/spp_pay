@extends('dashboard.layouts.app')
@section('title', 'Laporan Tunggakan')

@section('content')
<div class="row">
  <div class="col-xs-12">
    <h3 class="pull-left" style="margin-top:0px;">@yield('title')</h3>
  </div>
  
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
      <div class = "col-xs-4"><h3><b>filter</b></h3></div>
      <div class="form-group col-xs-12" style="margin-top:0px;">
          <select id="select-categories" class="form-control col-sm-3 float-right ml-2"> 
            <option value="">Semua Kelas</option> 
            <option value="1" {{Request::get('categories') == '6' ? 'selected' : ''}}>X IPA 1</option>
            <option value="2" {{Request::get('categories') == '14' ? 'selected' : ''}}>X IPA 2</option>
          </select>
        </div>
        <div class="form-group col-xs-3" style="margin-top:0px;">
          <select id="select-laporan" class="form-control col-sm-3 float-right ml-2"> 
            <option selected disabled value="">Pilih Laporan</option> 
            <option value="bulanan">Bulanan</option>
            <option value="tahunan">Tahunan</option>
          </select>
        </div>
        <div class="form-group col-xs-3" id = "bulanan" style="margin-top:0px;">
          <i>Bulan</i>
          <input type="month" id="bulan" class="form-control" placeholder="Bulanan">
        </div>
        <div class="form-group col-xs-3" id = "tahunan" style="margin-top:0px;">
          <i>Tahun</i>
          <select id="tahun" class="form-control col-sm-3 float-right ml-2"> 
            <option selected disabled value="">Pilih Tahun</option> 
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2019">2018</option>
            <option value="2019">2018</option>
          </select>
        </div>
        <br>
        <div class="col-xs-2"><button class="btn btn-success" onclick='hai()'>Terapkan</button></div>
      </div>

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
        <table id="example1" class="table table-bordered table-striped" style="width:100%!important">
            <thead>
            <tr>
                <th width="10"></th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Tagihan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
            </thead>
            @foreach($lap_tunggakan as $lap)
            <tbody>
            <tr>
                <th width="10">{{$loop->iteration}}</th>
                <th>{{$lap->getSiswa->nama_siswa}}</th>
                <th>{{$lap->getSiswa->kelas->nama}}</th>
                <th>{{$lap->getTagihan->nama}}</th>
                <th>{{$lap->getTagihan->jumlah}}</th>
                <th width="100">Rp. {{$lap->getTagihan->created_at}}</th>
            </tr>
            </tbody>
            @endforeach
            </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
function hai() {
  var kelas = $('#select-categories').val();
  var bulan = $('#bulan').val();
  var tahun = $('#tahun').val();
  var url = '{{route('lap.tunggakan')}}?kelas=' + kelas + '&bulan=' +bulan+ '&tahun='+tahun;
  
  // console.log(url);
  window.location = `${url}`;
}
</script>
  <script type="text/javascript"> 
    // $(function() {
    //   showdata('');
    // });

    function showdata($data) {
      $('#tagihanberanda-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('tagihan.beranda.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', searchable: false, orderable: false },
        { data: 'nama_tagihan', name: 'nama_tagihan' },
        { data: 'jumlah', name: 'jumlah' },
        { data: 'keterangan', name: 'keterangan' }
        ]
      });
    }
  </script>

  <script>
  $('#bulanan').hide();
    $('#tahunan').hide();
    $('#select-laporan').change(function () {
    // hide all optional elements
    // $('.optional').css('display','none');
    
    
    $("select option:selected").each(function () {
       
        if($(this).val() == "bulanan") {
          $('#tahunan').hide();
          $('#bulanan').show();

        } else if($(this).val() == "tahunan") {
          $('#bulanan').hide();
          $('#tahunan').show();
        }
    });
    });
  </script>
@endpush