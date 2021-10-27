@extends('layouts.app')

@section('content')



<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Please register to proceed</h2>
        <p>Register</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('register') }}" method="post" role="form" class="php-email-form">
        @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="name" class="form-label">{{ __('Name') }}</label></h5>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <div class="col-md-6">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="manNumber" class="form-label">{{ __('Man Number') }}</label></h5>
                <input id="manNumber" type="number" class="form-control @error('manNumber') is-invalid @enderror" name="manNumber" value="{{ old('manNumber') }}" required autocomplete="name" autofocus>

                    <div class="col-md-6">

                        @error('manNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="email" class="form-label">{{ __('E-Mail Address') }}</label></h5>
                <input type=" text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></input>
                    <div class="col-md-6">

                        @error('email')
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
                            {{ __('Password') }}
                        </label>
                    </h5>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"></input>
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
                        <label for="password-confirm" class="form-label">
                            {{ __(' Confirm Password') }}
                        </label>
                    </h5>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <!---<div class="col-md-6">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>--->
                </div>
            </div>                                 
            <div class="my-3">
                <div class="loading">
                    Loading
                </div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center">
                <button type="submit">
                    {{ __('Login') }}
                </button>
                
            </div>
        </form>
        </div>
    </div>
    </div>    
</section>
@endsection
