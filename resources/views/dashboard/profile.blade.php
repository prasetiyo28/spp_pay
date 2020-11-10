@extends('dashboard.layouts.app')
@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box box-warning">
            <div class="box-body box-profile">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header" style="background-image: url(/assets/material/images/background-2.jpg);"></div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="/assets/images/user.png" alt="User Avatar">
                    </div>
                </div>
                <br>
                <div class="box"> </div>
                <div class="text-center" style="margin-bottom: 10px;">
                <h4 style="margin-bottom:0px;"><b>{{ucwords(Auth::user()->nama)}}</b></h4>
                {{Auth::user()->email}}
                </div>
                <!-- <form action="">
                    <div class="form-group text-center">
                        <input type="file" class="upload" id="image" name="image"><label class="custom-file-label" for="image">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-success bg-green btn-block">Change</button>
                </form> -->
            </div>
        </div>
    </div>

    <div class="col-md-9">
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
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Profile</h3>
                <h5 class="box-options pull-right" style="margin-top:0px;">Role : {{ucwords(Auth::user()->role)}}</h5>
            </div>
            <form action="#" method="post" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                <div class="box-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control "placeholder="Name" name="name" value={{Auth::user()->nama}}>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control "placeholder="Password" name="email" value={{Auth::user()->email}} readonly>
                    </div>
                    <!-- <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control "placeholder="Enter email" name="phone" value={{Auth::user()->phone}}>
                    </div> -->
                    <hr>
                    <h4>Ubah Password</h4>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Isi jika ingin ganti password" data-toggle="password">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control" data-toggle="password">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary bg-green btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

@push('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
<script type="text/javascript">
	$("#password").password('toggle');
</script>
@endpush
