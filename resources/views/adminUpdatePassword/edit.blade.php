@extends('layouts.app')

@section('content')



<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Update Admin Password</h2>
        <p>Change Your Password</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('adminChangePassword.update',[$userDetails->id]) }}" method="post" role="form" class="php-email-form">
        @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                    <h5>
                        <label for="password" class="form-label">
                            {{ __('New Password') }}
                        </label>
                    </h5>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password"></input>
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
                    {{ __('Update Password') }}
                </button>
                
            </div>
        </form>
        </div>
    </div>
    </div>    
</section>
@endsection
