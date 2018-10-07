@extends('layouts.app')

@section('content')
<!-- <login></login> -->
    <div class="limiter">
        <div class="container-login100" style="background-image: url('/images/img-01.jpg');">
            <div class="wrap-login100 p-t-89 p-b-30">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.png" alt="AVATAR">
                    </div>
                    <span class="login100-form-title p-t-20 p-b-45">
                        LAPU-LAPU CITY DISTRICT HOSPITAL MANAGEMENT SYSTEM
                    </span>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
                        <input type="text" 
                               name="email" 
                               placeholder="Email Address" 
                               class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>

                        @if ($errors->has('email'))
                        {{ $errors->first() }}
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                        <input type="password"
                               placeholder="Password" 
                               id="password"
                               class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" 
                               name="password" 
                               required>

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{$errors->first()}}</strong>
                        </div>
                    @endif                        
                    <div class="container-login100-form-btn p-t-10">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
                    <div class="text-center w-full p-t-25 p-b-230">
                        <a  href="#" class="txt1">
                            Forgot Username / Password?
                        </a>
                    </div>
            </div>
        </div>
    </div>
<!-- <div class="container">
   <center><img src="{{ asset('images/llc_logo.png')}}" class="text-center" width="200">
</center>    
<div class="row justify-content-center" style="margin-top: 50px;">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center" style="text-transform: uppercase;font-weight: bold;background-color: teal;color:white;">{{ __('Administrator') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" style="margin-top: 65px;">
                <p class="back-link">Developed by <a href="#">Jendy Manatad</a></p>
    </div>
</div> -->
@endsection
