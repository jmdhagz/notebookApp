<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin.css') }}">
        <link href="{{asset('css/font-awesome-4.2.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <style type="text/css">
            .navbar {
                background-color: #6B5095 !important;
            }

            #nav_collapse {
                margin-top: 10px;
            }

            .navbar-toggler {
                border: 1px solid #FFE484 !important;
            }

            .nav-item {
                padding: 10px;
            }

            /* width */
            ::-webkit-scrollbar {
                width: 2px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                /*background: #f1f1f1; */
            }
             
            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #555;
            }


            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }

            @font-face {
                font-family: Nexa;
                src: url({{ URL::asset('fonts/nexa/nexa_light-webfont.woff') }});
            }

            @font-face {
                font-family: RailWayRegular;
                src: url({{ URL::asset('fonts/railway/raleway-regular-webfont.woff') }});
            }
        </style>
        <!-- Styles -->
    </head>
    <body>
        @yield('content')
        <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
        <script src="{{asset('js/popper/popper.min.js')}}"></script>
        <script src="{{asset('js/sb-admin.min.js')}}"></script>
        <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/vue.js') }}"></script>

        @yield('scripts')
    </body>
</html>
