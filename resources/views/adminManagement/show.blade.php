@extends('layouts.app')

@section('content')
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Admin Details</h2>
          <p>{{$userDetails->name}}</p>
        </div>

        <div class="row">
          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-person-badge"></i>
                <h4>Man Number :<h4 style="color: #eb5d1e;">{{$userDetails->manNumber}}</h4>
                <p>Livestock Services employee number</p>
              </div>
              
              
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email :<h4 style="color: #eb5d1e;">{{$userDetails->email}}</h4></h4>
                <p>Livestock Services email address</p>
              </div>
              
              <a href="{{ route('userManagement.edit',[$userDetails->id]) }}"><div class="phone">
                <i class="bi bi-laptop"></i>
                <h4>Edit User</h4>
                <p>Edit User Account</p>
              </div></a>

              <a href="{{ route('userManagement.resetPassword',[$userDetails->id]) }}"><div class="phone">
                <i class="bi bi-key"></i>
                <h4>Reset Password</h4>
                <p>Reset User Password</p>
              </div></a>

              <a href="{{ route('userManagement.resetPassword',[$userDetails->id]) }}"><div class="phone">
                <i class="bi bi-dash-circle"></i>
                <h4>Deactivate Account</h4>
                <p>Deactivate User Account</p>
              </div></a>
              <!---<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>--->
            </div>
          </div>
                  
            
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch " data-aos="fade-up" data-aos-delay="100" style="width: -webkit-fill-available;">
                <!-- ======= F.A.Q Section ======= -->
                <section id="faq" class="faq section-bg" style="width: 100%;">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                    <h2>Oldest 5 Queries</h2>
                    <p>Pending Queries</p>
                    </div>

                    <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">                    
                    @if($countUserAssignedQueries > 0)
                      @foreach($userAssignedQueries as $userAssignedQuerie)
                    
                        <li>
                          <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$userAssignedQuerie->queryDetails}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                          <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                          
                            <!---<button type="button" class="btn btn-custom-primary">Button</button>--->
                          </div>
                        </li>
                      @endforeach
                    @else                      
                      <li>
                          <div data-bs-toggle="" class="collapsed question" href="#faq1">No Pending Queries For This User<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                          <div id="faq1" class="collapse" data-bs-parent=".faq-list">                        
                          </div>
                      </li>
                      @endif
                    </ul>
                </div>
            </section>           
          </div>
        </div>
      </div>
    </section><!-- End Contact Us Section -->  
@endsection