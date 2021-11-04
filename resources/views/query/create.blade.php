@extends('layouts.app')

@section('content')


</section><!-- End Clients Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{$categories->categoryName}} Query Form</h2>
          <p>Please enter your {{$categories->categoryName}} related Query</p>
        </div>

        <div class="row">

        
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
            <form action="{{route('query.store')}}" method="post" role="form" class="php-email-form">
            @csrf
              <div class="row">
              @if(count($subCategories) > 0)
                <div class="form-group mt-3">
                  <select name= "subCategoryId"class="form-control" >
                    <option class="font-weight-bold" ><b>Select Category</b></option>
                     @foreach ($subCategories as $subCategorie)
                        <option class="font-weight-bold" value="{{ $subCategorie->id }}"}}> 
                          <b>{{$subCategorie->subCategoryDescription}}</b>
                        </option>
                    @endforeach  
                  </select>
                </div>                               
               @else
              <select name= "subCategoryId"class="form-control" >
                <option class="font-weight-bold" ><b>NO OPTIONS AVAILABLE</b></option>
              </select>                               
              @endif                
              </div>

              <div class="form-group mt-3">
              <h5>
                <label for="query" class="form-label">Enter Description</label>
              </h5>
                <textarea rows="5" type=" text" id="queryDetails" class="form-control" name="queryDetails"></textarea>
                <input type="hidden" value="{{ $categories->id }}" id="categorieId" class="form-control"name="categorieId">
              </div>              
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Submit Query</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>

@endsection

