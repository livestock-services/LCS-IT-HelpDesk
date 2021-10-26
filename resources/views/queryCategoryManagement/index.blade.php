@extends('layouts.app')

@section('content')

<!----CONDUSIVE --->
<!-- ======= Services Section ======= -->
<section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Querie Categories</h2>
          <p>View all Query Categories</p>
        </div>
        @if(count($categories) > 0)
        @foreach($categories as $categorie)

        <div class="row ">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="{{$categorie->id}}">{{$categorie->categoryName}}</a></h4>
              <input type="hidden" value="{{ $categorie->id }}" id="categorieId" class="form-control"name="categorieId">
              <p class="description">{{$categorie->categoryDescription}}</p>
            </div>
          </div>

          
          @endforeach
          @else
            <h1>categories</h1>    
                <h4>No Cateregories available at the moment</h4>
            @endif 

          

        </div>

      </div>
    </section><!-- End Services Section -->
@endsection
