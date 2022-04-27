@extends('layouts.app')

@section('content')
<!-- ======= F.A.Q Section ======= -->

<section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>All Admin Users</h2>
                <p>Admins</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

            @if(count($adminUsers) > 0)
                @foreach($adminUsers as $adminUser)
                <li>
                <a href="{{ route('adminManagement.show',[$adminUser->id]) }}"><div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$adminUser->name}} <div style="float: right;"></div><i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        
                        <!---<button type="button" class="btn btn-custom-primary">Button</button>--->
                    </div>
                </li>
                @endforeach
            @else
            <li>
            <p>
                No Accounts available
            </p>
            @endif
            </ul>
        </div>
    </section> 

@endsection