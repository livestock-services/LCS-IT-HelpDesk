@extends('layouts.app')

@section('content')

</section><!-- End Clients Section -->
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>IT Category Query Form</h2>
          <p>Submit Your Query Category</p>
        </div>

        <div class="row">

          

          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
            <form action="{{route('category.store')}}" method="post" role="form" class="php-email-form">
              
              <div class="form-group mt-3">
              <h5>
                <label for="name" class="form-label">Enter Query Category</label>
              </h5>
                <textarea rows="5" type=" text" id="query" class="form-control" name="query"></textarea>
              </div>              
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
</section>

@endsection

