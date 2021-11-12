@extends('layouts.app')

@section('content')

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Query Viewer</h2>
          <p>View Query Details</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Status:</h4>
                <p>"To be inseted"</p>
              </div>

              <a href="{{$categories->id}}/edit"><div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Assinged:</h4>
                <p>"To be inserted"</p>
              </div></a>

              <a href="{{ route('subCategory.create',[$categories->id]) }}"><div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Add Sub Category:</h4>
                <p>Register a new Sub Category under</p>
              </div></a>
              <!---<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>--->
            </div>
          </div>
                  
            
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch " data-aos="fade-up" data-aos-delay="100" style="width: -webkit-fill-available;">
                <!-- ======= F.A.Q Section ======= -->
                <section id="faq" class="faq section-bg" style="width: 100%;">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                    <h2>Sub Category Management</h2>
                    <p> Sub Categories</p>
                    </div>

                    <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

                    
                    <li>
                        <div data-bs-toggle="" class="collapsed question" href="#faq1">No Sub Categories available<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        
                        </div>
                    </li>
                    

                    

                    

                    </ul>

                </div>
            </section>           
          </div>
        </div>
      </div>
    </section><!-- End Contact Us Section -->  
@endsection