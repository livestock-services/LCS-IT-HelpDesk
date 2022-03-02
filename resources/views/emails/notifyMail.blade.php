<!DOCTYPE html>
<html>
    <head>
        <title>LSC HELP DESK</title>
    </head>
    <body>
        <h3>Subject : {{$data['categoryDetails']}}</h3ph>
        <h4>{{$data['subCategoryDetails']}}</h4>
        <h5>{{$data['queryDetails']}}</h5> 
        <h5>From: <b>{{ Auth::user()->name }}</b></h5>
        <h5>Email: {{Auth::user()->email}}</h5>
    </body>
</html> 