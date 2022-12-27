@extends('layouts.app')

@section('content')
<!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Querie Reports</h2>
                <p>All Queries</p>
            </div>

            <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
            @if(count($queries) > 0)
                <div class="well">
                
                <tr><td>    <h4 class="text-primary">Said enough</h3>
                    <h6><b>Said enough</h5></b>
                    </td>
                    
                    <td>
                    <h4>Said enough</h4> 
                    <small></small>
                    </td><td>
                <h1>Said enough</h1>
                    </td>
                </div>           
        </div>

            <div class="card-body">
            <table  class="table table-hover">
                    <tbody>
                            <thead>
                                    <tr>
                                    <th scope="col"><h4>Location</h4></th>
                                    
                                    <th scope="col"><h4>Date Sent</h4></th>
                                    
                                    </tr>
                            </thead>
                @foreach($queries as $query)
                <li>
                <a href="{{ route('adminQueries.showPendingQueries',[$query->id]) }}"><div data-bs-toggle="collapse" class="collapsed question" href="#faq1">{{$query->queryDetails}}  {{$query->subCategoryDescription}} {{$query->name}} {{$query->adminName}}{{$query->statusId}} {{$query->priorityCode}}<div style="float: right;">{{$query->queryDetails}}</div><i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div></a>
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
            </li>
            @endif
            </tbody>
            </table>
        </div>
    </section>   
@endsection