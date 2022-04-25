@extends('layouts.app')

@section('content')
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Change password to proceed..</h2>
        <p>Reset Password</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('reset.password.submit') }}" method="post" role="form" class="php-email-form">
        @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <h5>
                        <label for="password" class="form-label">
                            {{ __('Current Password') }}
                        </label>
                    </h5>
                    <input type="password" id="current_password" class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="current-password"></input>
                    <div class="col-md-6">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <h5>
                        <label for="password" class="form-label">
                            {{ __('New Password') }}
                        </label>
                    </h5>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" ></input>
                    <div class="col-md-6">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <h5>
                        <label for="password" class="form-label">
                            {{ __('Confirm Password') }}
                        </label>
                    </h5>
                    <input type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" ></input>
                    <div class="col-md-6">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <!---<div class="container">
                <div class="row align-items-center ">
                    <div class="col-md-3">    
                    </div>
                    <div class="form-group col-md-auto">
                        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <div class="form-group col col-lg-2">
                        <label  for="remember">
                            {{ __('Remember Me') }}
                        </label> 
                    </div>
                </div>
            </div>-->                      
            <div class="my-3">
                <div class="loading">
                    Loading
                </div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center">
                <button type="submit">
                    {{ __('Submit') }}
                </button>
                @if (Route::has('password.request'))
                    <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>--->
                @endif
            </div>
        </form>
        </div>
    </div>
</div>    
</section>
@endsection