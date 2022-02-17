<!DOCTYPE html>
<html>
    <head>
        <title>LSC HELP DESK</title>
    </head>
    <body>
        <h3>Subject : {{$data['categoryDetails']}}</h3>
        <h4>{{$data['subCategoryDetails']}}</h4>
        <h5>{{$data['queryDetails']}}</h5> 
        <h5>From: <b>{{ Auth::user()->name }} [{{Auth::user()->email}}]</b></h5>
    </body>
</html> 