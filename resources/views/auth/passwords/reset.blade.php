@extends('layouts.app')

@section('content')
<div class="login-form">  
     @if (session('status'))
        <div class="alert alert-success" role="alert">
              {{ session('status') }}
        </div>
     @endif  
     <form method="POST" action="{{ route('password.update') }}">
                        @csrf
         <input type="hidden" name="token" value="{{ $token }}">
		<div class="avatar"><img src="{{asset('/storage/logo.png')}}"/></div>
    	<h4 class="modal-title">Password Reset</h4>
        <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                 name="password" required autocomplete="new-password" placeholder="New password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" 
        placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Reset Password">              
    </form>			
</div>
@endsection
