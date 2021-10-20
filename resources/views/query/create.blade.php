@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Submit your query</h1>
                </div>
                    <div class="card-body">

                        <form method="POST" action="{{route('query.store')}}">
                            @csrf
                            <!-- {{ csrf_field() }} -->                       
                            <div class="form-group">
                                <select name= "catergoryOfProduct" class="form-control" >
                                    <option class="font-weight-bold" >
                                        <b>Select Category</b>                                        
                                    </option>                        
                                </select>
                            </div>  
                            
                            <div class="form-group">
                                <select name= "catergoryOfProduct" class="form-control" >
                                    <option class="font-weight-bold" >
                                        <b>Select Category</b>                                        
                                    </option>                        
                                </select>
                            </div>

                            <div class="form-group">
                                <select name= "catergoryOfProduct" class="form-control" >
                                    <option class="font-weight-bold" >
                                        <b>Select Category</b>                                        
                                    </option>                        
                                </select>
                            </div>
                               
                            <div class="form-outline mb-4">
                                <h5>
                                    <label for="name" class="form-label">Enter query</label>
                                </h5>
                                <textarea rows="5" type=" text" id="query" class="form-control" name="query"></textarea>                                
                                <br>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>  
                                </div> 
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

