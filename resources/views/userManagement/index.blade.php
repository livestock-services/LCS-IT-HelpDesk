@extends('layouts.app')

@section('content')
<!-- ======= F.A.Q Section ======= -->

<section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>All Registered Users</h2>
                <p>Users</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

            @if(count($allUsers) > 0)
                @foreach($allUsers as $allUser)
                <li>
                <a href="{{ route('userManagement.show',[$allUser->id]) }}"><div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$allUser->name}}<div style="float: right;"></div><i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        
                        <!---<button type="button" class="btn btn-custom-primary">Button</button>--->
                    </div>
                </li>
                @endforeach
            </ul>
                {{ $allUsers->links() }}
            @else
            
            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
            <li>
            <p>
                No Accounts available
            </p>
            @endif
            </ul>
        </div>
    </section> 

@endsection