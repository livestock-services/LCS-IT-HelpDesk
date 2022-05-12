@extends('layouts.app')

@section('content')

<!-- ======= Contact Us Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Login into your account to proceed</h2>
        <p>Login</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('login') }}" method="post" role="form" class="php-email-form">
        @csrf
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
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-md-3">    
                    </div>
                    
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
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="">
                        
                    </a>
                @endif
            </div>
        </form>
        </div>
    </div>
</div>    
</section>
@endsection
