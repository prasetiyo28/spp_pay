@extends('beranda.layouts.app')
@section('title', 'Profile')

@section('content')
<div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Profil
          <small>Siswa</small>
        </h1>
      <!--   <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">

<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-solid box-warning">
      <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="/assets/images/user2.png" alt="User profile picture">
        <h3 class="profile-username text-center"> {{ucwords(Auth::user()->nama)}}</h3>
        <p class="text-muted text-center">{{ucwords(Auth::user()->email)}}</p>
        <form action="">
        <span class="btn btn-success btn-file">
            Choesee <input type="file"> 
        </span>
        </form>
        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <!-- <div class="shadow p-3 mb-5 bg-white rounded">Regular shadow</div> -->
    <div class="box box-solid box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Profil Siswa</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">

            <p class="help-block">Example block-level help text here.</p>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@push('header')
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
@endpush

