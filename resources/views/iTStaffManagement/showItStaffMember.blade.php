@extends('layouts.app')

@section('content')
<!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Pernsonnel Assinged Queries</h2>
                <p>I.T Queries under Selected</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

            @if(count($staffMemberQueries) > 0)
                @foreach($staffMemberQueries as $staffMemberQuerie)
                <li>
                <div data-bs-toggle="collapse" class="collapsed question" >{{$staffMemberQuerie->queryDetails}} <div style="float: right;">{{$staffMemberQuerie->name}}</div><i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div></a>
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