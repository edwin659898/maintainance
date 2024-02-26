@extends('layouts.app')

@section('content')
   <div class="login-form">    
   <form method="POST" action="{{ route('login') }}">
                        @csrf
		<div class="avatar"><img src="{{asset('/storage/logo.png')}}"/></div>
    	<h4 class="modal-title">Login to Your Account</h4>
        <div class="form-group">
        <input id="email" type="email" class="form-control @error('email')
             is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
         name="password" required autocomplete="current-password" placeholder="Password">
           @error('password')
            <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
        </div>
        <div class="form-group small clearfix">
            <label class="form-check-label"><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
            @guest
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
            @endif
            @endguest
        </div> 
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">              
    </form>			
    <div class="text-center text-white small">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
</div>
@endsection
