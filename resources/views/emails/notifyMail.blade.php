<!DOCTYPE html>
<html>
    <head>
        <title>LSC HELP DESK</title>
    </head>
    <body>
        <h1>Query Subject : {{$data['categoryDetails']}}</h1>
        <h2>{{$data['subCategoryDetails']}}</h2>
        <h3>{{$data['queryDetails']}}</h3> 
        <h3>From: <b>{{ Auth::user()->name }}</b></h3>
        <h3>Email: {{Auth::user()->email}}</h3>
        <!---<picture>
            <img src="img/LSC.jpg" />
        </picture>--->
    </body>
</html> 