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
          <p>Query By {{$querie->name}}</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Status:</h4>
                @if($querie->queryType == 1)
                <p style="color:red;"><b>Pending</b></p>
                @elseif($querie->queryType == 2)
                <p style="color:blue;"><b>Under Work</b></p>
                @else
                <p style="color:green;"><b>Completed</b></p>
                @endif
              </div>

              
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Query Assinged to :</h4>
                <p style="color:blue;"><b>{{$querie->adminName}}</b></p>
              </div>

              <!---<a href="{{ route('adminQueries.clearUserQuery',[$querie->id]) }}"><div class="phone">
                <i class="bi bi-phone"></i>
                <h4 style="color:green;">Clear Query</h4>                
              </div></a>--->
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
                          <div data-bs-toggle="collapse"class="collapsed question" href="#faq1">{{$querie->queryDetails}}<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
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
        <p>Something went wrong</p>        
    @endif
@endsection