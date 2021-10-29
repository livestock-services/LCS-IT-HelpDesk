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
            <form action="/queryManagent/{{$categories->id}}" method="post" role="form" class="php-email-form">
            @csrf
            {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="row">
                <div class="form-group col-md-3">
                  <h5><label for="name" class="form-label">Enter Query Category</label></h5>
                  <input placeholder="{{$categories->categoryName}}" value="{{$categories->categoryName}}" type=" text" id="categoryName" class="form-control" name="categoryName"></input>
                </div>
                <div class="form-group col-md-9 mt-9 mt-md-0">
                  <!---<h5><label for="name" class="form-label">Enter Category Description</label></h5>---->
                  <!---<textarea rows="5" type=" text" id="categoryDescription" class="form-control" name="categoryDescription"></textarea>--->
                  <h5><label for="name" class="form-label">Enter Category Description</label></h5>
                  <input placeholder="{{$categories->categoryDescription}}"  value="{{$categories->categoryDescription}}" type="text" id="categoryDescription" class="form-control" rows="3" name="categoryDescription" spellcheck="true" style="overflow:auto"></input>
                  <!---<textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" required></textarea>---->
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

