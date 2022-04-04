@extends('layouts.app')

@section('content')


</section><!-- End Clients Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>User Role Form</h2>
          <p>Please enter User Role Name</p>
        </div>

        <div class="row">

        
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
            <form action="{{route('query.store')}}" method="post" role="form" class="php-email-form">
            @csrf
              <div class="form-group mt-3">
              <h5>
                <label for="query" class="form-label">Enter Role Name</label>
              </h5>
                  <input type=" text" id="categoryName" class="form-control" name="categoryName"></input>
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
