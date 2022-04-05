@extends('layouts.app')
@section('content')
<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>View Roles</h2>
            <p>All Admin Roles</p>
        </div>
        <div class="row ">
        @if(count($allRoles) > 0)
        @foreach($allRoles as $role)        
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                    <h4 class="title"><a href="">{{$role->name}}</a></h4>
                    <input type="hidden" value="" id="categorieId" class="form-control"name="categorieId">
                <p class="description"></p>
            </div>
        </div>          
        @endforeach
        @else
        </div>
        <h1>categories</h1>    
            <h4>No Cateregories available at the moment</h4>
        @endif
    </div>
</section><!-- End Services Section -->
@endsection