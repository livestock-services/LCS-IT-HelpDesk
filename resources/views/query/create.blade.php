@extends('layouts.app')

@section('content')


</section><!-- End Clients Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>IT Query Form</h2>
          <p>Submit your Query</p>
        </div>

        <div class="row">

          

          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="2">
            <form action="{{route('query.store')}}" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                    <select name= "catergoryOfProduct" class="form-control" >
                        <option class="font-weight-bold" >
                            <b>Select First Category</b>                                        
                        </option>                        
                    </select>
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                    <select name= "catergoryOfProduct" class="form-control" >
                        <option class="font-weight-bold" >
                            <b>Select Second Category</b>                                        
                        </option>                        
                    </select>
                </div>
              </div>
              <div class="form-group mt-3">
              <h5>
                <label for="name" class="form-label">Enter query</label>
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

