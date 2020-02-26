<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single Page App</title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
    <v-app>
        <app-home></app-home>
    </v-app>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
