<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app">
       <v-app>
         <v-content>
          <v-container>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, culpa sit? Aspernatur alias amet harum rerum nam minus earum numquam reiciendis mollitia beatae quibusdam eum, possimus corrupti voluptatibus ex id?</v-container>
         </v-content>
         <v-content>
           <div>
              <v-alert
                border="top"
                color="red lighten-2"
                dark
              >
                I'm an alert with a top border and red color
              </v-alert>
              <v-alert
                border="right"
                color="blue-grey"
                dark
              >
                I'm an alert with a right border and blue-grey color
              </v-alert>
              <v-alert
                border="bottom"
                color="pink darken-1"
                dark
              >
                I'm an alert with a bottom border and pink color
              </v-alert>
              <v-alert
                border="left"
                color="indigo"
                dark
              >
                I'm an alert with a border left type info
              </v-alert>
            </div>
         </v-content>
       </v-app>
      </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>