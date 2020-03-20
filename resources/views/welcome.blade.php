<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Overseer</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{mix('css/app.css')}}" rel="stylesheet" />
</head>
<body>
<div id="app">
    <dashboard-component :token="'{{ $token }}'"></dashboard-component>
</div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
