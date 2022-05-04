@extends('layouts.app')

@section('content')



<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Update User Information</h2>
        <p>Edit Account</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('adminManagement.updateUserCredentials',[$adminDetails->id]) }}" method="post" role="form" class="php-email-form">
        @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="name" class="form-label">{{ __('Name') }}</label></h5>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$adminDetails->name}}" required autocomplete="name" autofocus>
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
                <h5><label for="name" class="form-label">{{ __('User Role') }}</label></h5>
                    <select name= "userRole" class="form-control">                    
                    @foreach ($roles as $role) 
                        @if ($usersRole == $role->name)
                        <b><option class="font-weight-bold" value="{{$role->name}}" selected>{{ $role->name }}</option></b>
                        @else
                        <b><option class="font-weight-bold" value="{{$role->name}}">{{ $role->name }}</option></b>
                        @endif                       
                        
                    @endforeach 
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="manNumber" class="form-label">{{ __('Man Number') }}</label></h5>
                <input style="text-transform:uppercase" id="manNumber" type="text" class="form-control @error('manNumber') is-invalid @enderror" name="manNumber" value="{{$adminDetails->manNumber}}" required autocomplete="name" autofocus>

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
                <input type=" text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$adminDetails->email}}" required autocomplete="email" autofocus></input>
                    <div class="col-md-6">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                    {{ __('Update') }}
                </button>
                
            </div>
        </form>
        </div>
    </div>
    </div>    
</section>
@endsection
