@extends('layouts.app')

@section('content')

    <h1>{{$categories->categoryName}}</h1>
   
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" > 
                            <a href="{{$categories->id}}/edit" class="btn btn-default">Edit</a>
                                <div class="form-group row">
                                    <div class="form-group row">                                           
                                        <input type="hidden" value="{{ $categories->id }}" id="categorieId" class="form-control"name="categorieId">
                                        <button type="submit" class="btn btn-primary btn-block">DELETE</button>
                                    </div> 
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <hr>
   
@endsection