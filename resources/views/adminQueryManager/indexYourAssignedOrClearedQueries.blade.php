@extends('layouts.app')

@section('content')
<!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>User Queries</h2>
                <p>All I.T Queries</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

            @if(count($queries) > 0)
                @foreach($queries as $query)
               
                <li>
                <a href="{{ route('adminQueries.show',[$query->id]) }}"><div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$query->queryDetails}}<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        
                        <!---<button type="button" class="btn btn-custom-primary">Button</button>--->
                    </div>
                </li>
                @endforeach
            @else
            <li>
                <div data-bs-toggle="" class="collapsed question" >No User queries have been made<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                
                </div>
            </li
            @endif
            </ul>
        </div>
    </section>   
@endsection