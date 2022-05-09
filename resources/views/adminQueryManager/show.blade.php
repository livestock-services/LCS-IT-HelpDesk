@extends('layouts.app')

@section('content')
@if(count($queries) > 0)
    @foreach($queries as $querie)
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          @if($querie->queryType == 1)
          <h2>Unassinged Query Viewer</h2>
          @elseif($querie->queryType == 2)
          <h2>Assinged Query Viewer</h2>
          @else
          <h2>Cleared Query Viewer</h2>
          @endif
          <p>View Query Details </p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-info-circle"></i>
                <h4>Status:</h4>
                @if($querie->statusId == 3)
                <p style="color:green;"><b>Completed</b></p>                
                @elseif($querie->statusId == 2)
                <p style="color:blue;"><b>Assigned</b></p>
                @else
                <p style="color:red;"><b>Pending</b></p>
                @endif
              </div>
              @if($querie->statusId == 1)
              <a href="{{route('viewITStaffMembers.index',[$querie->id])}}">
              <div class="email">
                <i class="bi bi-briefcase-fill"></i>
                <h4>Assign To I.T Staff</h4>               
              </div></a>
              @endif              
            </div>
          </div>           
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch " data-aos="fade-up" data-aos-delay="100" style="width: -webkit-fill-available;">
                <!-- ======= F.A.Q Section ======= -->
                <section id="faq" class="faq section-bg" style="width: 100%;">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                    <h2>Query Details</h2>
                    <p>{{$querie->subCategoryDescription}}</p>
                    </div>
                    <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">                    
                      <li>
                          <div data-bs-toggle="" class="collapsed question" href="#faq1">{{$querie->queryDetails}}<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                          <div id="faq1" class="collapse" data-bs-parent=".faq-list">                            
                        </div>
                      </li>
                    </ul>
                </div>
            </section>           
          </div>
        </div>
      </div>
    </section>
    @endforeach         
    @else
        <p>Nothing Available</p>        
    @endif<!-- End Contact Us Section -->  
@endsection<!-- End Contact Us Section -->  
