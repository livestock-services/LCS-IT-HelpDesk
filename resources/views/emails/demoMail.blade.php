<!DOCTYPE html>
<html>
    <head>
        <title>LSC HELP DESK</title>
    </head>
    <body>
        <h1>Query : {{$data['categoryDetails']}}</h1>
        <h2>{{$data['subCategoryDetails']}}</h2>
        <h3>{{$data['queryDetails']}}</h3> 
        <h3>From {{ Auth::user()->email }}</h3>
    </body>
</html> 