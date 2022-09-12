@extends('layouts.app')

@section('content')
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
    <div class="section-title">
        <h2>Set Query Priority</h2>
        <p>Query : {{$queries->queryDetails}}</p>
    </div>
    <div class="row">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
        <form action="{{ route('assignPriority.set',[$queries->id]) }}" method="post" role="form" class="php-email-form">
        @csrf            
            <div class="row justify-content-center">
                <div class="form-group col-md-6">
                <h5><label for="name" class="form-label">{{ __('Query Priority') }}</label></h5>
                    <select name= "queryPriority" class="form-control">                    
                    @foreach ($getPriorities as $getPrioritie) 
                        @if ($currentQueryPriority == $getPrioritie->priorityCode)
                            <b><option class="font-weight-bold" value="{{$getPrioritie->priorityCode}}" selected>{{ $getPrioritie->priorityName }}</option></b>
                        @else
                            <b><option class="font-weight-bold" value="{{$getPrioritie->priorityCode}}">{{ $getPrioritie->priorityName }}</b>
                        @endif                       
                    @endforeach 
                    </select>
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
