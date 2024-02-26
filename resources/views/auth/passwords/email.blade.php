@extends('layouts.app')

@section('content')
<div class="login-form">  
     @if (session('status'))
        <div class="alert alert-success" role="alert">
              {{ session('status') }}
        </div>
     @endif  
     <form method="POST" action="{{ route('password.email') }}">
                        @csrf
		<div class="avatar"><img src="{{asset('/storage/logo.png')}}"/></div>
    	<h4 class="modal-title">Reset Password</h4>
        <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Send Password Reset Link">              
    </form>			
    <div class="text-center text-white small">Remembered your Password? <a href="{{ route('login') }}">Log in</a></div>
</div>
@endsection
