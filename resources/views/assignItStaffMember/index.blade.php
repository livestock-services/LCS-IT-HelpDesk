@extends('layouts.app')

@section('content')



    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Administrators</h2>
          <p>IT Staff Members</p>
        </div>
        @if(count($iTStaffs) > 0)
          @foreach($iTStaffs as $iTStaff)
            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
            
              <li>
                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$iTStaff->name}} <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                  <div class="button-box-az col-lg-12">
                    <a href="{{ route('assignQuery.select',['query'=>$queryId,'adminId'=>$iTStaff->id]) }}" class="btn btn-success" role="button">Assign</a> 
                    <a href="{{ route('showITStaffMember.show',[$iTStaff->id]) }}" class="btn btn-info" role="button">View</a>                             
                  </div>
                </div>
              </li>
            </ul>
            @endforeach
            @else
            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">            
              <li>
                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">No Admin Accounts available <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    No Admin Accounts available
                  </p>
                </div>
              </li>
            </ul>
            @endif
      </div>
    </section>
@endsection