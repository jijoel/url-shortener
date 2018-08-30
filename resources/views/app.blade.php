<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{mix('/css/app.css')}}">
    <title>Laravel</title>
  </head>
  <body>
    <div id="app">
      <v-app>
        <v-content>
          <short-url-component></short-url-component>
        </v-content>
      </v-app>
    </div>

  <script src="{{mix('/js/app.js')}}"></script>
  </body>
</html>
