@extends('layouts.app')

@section('content')
<div class="login-form">    
  <form method="POST" action="{{ route('register') }}">
                        @csrf
		<div class="avatar"><img src="{{asset('/storage/logo.png')}}"/></div>
        <h4 class="modal-title">Register Account</h4>
        <div class="form-group">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your owesam Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your owesam Email">

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
   @enderror
        </div>

        <div class="form-group">
                  <select class="form-control" name="site"  required >
                                          <option value="">Select Site</option>
                                          <option value="Head Office">Head Office</option>
                                          <option value="Kiambere">Kiambere</option>
                                          <option value="Dokolo">Dokolo</option>
                                          <option value="Nyongoro">Nyongoro</option>
                                          <option value="7 Forks">7 Forks</option>
                                          <option value="Sosoma">Sosoma</option>
                                          <option value="Kampala">Kampala</option>
                                          <option value="Tanzania">Tanzania</option>
                 </select>
        </div>

        <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
        name="password" required autocomplete="new-password" placeholder="Your Favourite Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" 
            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Register">              
    </form>			
    <div class="text-center text-white small">Already have an account? <a href="{{ route('login') }}">Log in</a></div>
</div>
@endsection
