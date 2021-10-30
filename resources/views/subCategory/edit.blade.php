@extends('layouts.app')

@section('content')

</section><!-- End Clients Section -->
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Edit IT Category Query Form</h2>
          <p>Edit Your IT Query Category</p>
        </div>

        <div class="row">
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
            <form action="{{ route('subCategory.update',[$subCategories->id]) }}" method="post" role="form" class="php-email-form">
            @csrf
            {{ csrf_field() }}
              
              <div class="row justify-content-center">
                <div class="form-group col-md-6">
                  <h5><label for="name" class="form-label">Edit Sub Query</label></h5>
                  <input placeholder="{{$subCategories->subCategoryDescription}}" value="{{$subCategories->subCategoryDescription}}" type=" text" id="subCategoryDescription" class="form-control" name="subCategoryDescription"></input>
                </div>                
              </div>
                            
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Submit</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>

@endsection