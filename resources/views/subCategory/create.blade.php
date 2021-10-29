@extends('layouts.app')

@section('content')

<!-- ======= Contact Us Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h2>Submit Sub Query Category</h2>
        <p>Sub Query Category Form</p>
    </div>

    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('subCategory.store') }}" method="post" role="form" class="php-email-form">
        @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="subQueryCategory" class="form-label">{{ __('Sub Query Category') }}</label></h5>
                <textarea rows="3" type=" text" id="subQueryCategory" class="form-control @error('subQueryCategory') is-invalid @enderror" name="subQueryCategory" value="{{ old('subQueryCategory') }}" required autocomplete="subQueryCategory" autofocus></textarea>                
                <input name="categoryId" id="categoryId" type="hidden" value="{{$categoryId}}">
                    <div class="col-md-6">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
            </div>
           
                                 
            
            <div class="text-center">
                <button type="submit">
                    {{ __('Submit') }}
                </button>
                
            </div>
        </form>
        </div>
    </div>
</div>    
</section>
@endsection
