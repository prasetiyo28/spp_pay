@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-login mx-auto">
            <div class="card">

                <div class="card-body p-6">
                    <div class="card-title text-center">{{ __('Login akun Anda') }}</div>
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert"></button>    
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email" tabindex="1">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}

                            @if (Route::has('password.request'))
                                <a class="float-right small" href="{{ route('password.request') }}" tabindex="3">
                                    {{ __('Saya lupa password') }}
                                </a>
                            @endif</label>

                            <div class="">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password" tabindex="2">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-footer">
                        <!-- <a href="{{route('dashboard.index')}}" class="btn btn-success btn-block" tabindex="5">Login</a> -->
                            <button type="submit" class="btn btn-success btn-block" tabindex="5">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
