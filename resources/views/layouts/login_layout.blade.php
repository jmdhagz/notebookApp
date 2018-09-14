<!DOCTYPE html>

<html lang="en">

    <head id="Starter-Site">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        
        <style type="text/css">
            body {
                background-color: #6B5095 !important;
            }

            .modal-header {
                background-color: #6B5095;
                color: white;
            }
            .navbar {
                background-color: #6B5095 !important;
            }

            h1, h2, h3 {
                font-family: OpenSansRegular;
            }

            @font-face {
                font-family: RobotoSlab;
                src: url({{ URL::asset('assets/site/fonts/RobotoSlab/robotoslab-regular-webfont.woff') }});
            }

            @font-face {
                font-family: OpenSansLight;
                src: url({{ URL::asset('assets/site/fonts/opensans-light-webfont.woff') }});
            }

            @font-face {
                font-family: OpenSansRegular;
                src: url({{ URL::asset('assets/site/fonts/opensans-regular-webfont.woff') }});
            }

            p, label {
                font-family: OpenSansRegular;
            }

            .btn-primary {
                background-color: #6B5095 !important;
                border-color: #6B5095 !important;
            }

            .btn-default {
                border-color: #6B5095 !important;
                color: #6B5095 !important;
            }

            .thumbnail {
                height: 300px !important;
            }
            .fadeInDown {
                -webkit-animation-name: fadeInDown;
                animation-name: fadeInDown;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }

            @-webkit-keyframes fadeInDown {
                0% {
                    opacity: 0;
                    -webkit-transform: translate3d(0, -100%, 0);
                    transform: translate3d(0, -100%, 0);
                }
                100% {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            @keyframes fadeInDown {
                0% {
                    opacity: 0;
                    -webkit-transform: translate3d(0, -100%, 0);
                    transform: translate3d(0, -100%, 0);
                }
                100% {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            /* Simple CSS3 Fade-in Animation */
            @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

            .fadeIn {
                opacity:0;
                -webkit-animation:fadeIn ease-in 1;
                -moz-animation:fadeIn ease-in 1;
                animation:fadeIn ease-in 1;

                -webkit-animation-fill-mode:forwards;
                -moz-animation-fill-mode:forwards;
                animation-fill-mode:forwards;   

                -webkit-animation-duration:1s;
                -moz-animation-duration:1s;
                animation-duration:1s;
            }

            .fadeIn.first {
                -webkit-animation-delay: 0.4s;
                -moz-animation-delay: 0.4s;
                animation-delay: 0.4s;
            }

            .fadeIn.second {
                -webkit-animation-delay: 0.6s;
                -moz-animation-delay: 0.6s;
                animation-delay: 0.6s;
            }

            .fadeIn.third {
                -webkit-animation-delay: 0.8s;
                -moz-animation-delay: 0.8s;
                animation-delay: 0.8s;
            }

            .fadeIn.fourth {
                -webkit-animation-delay: 1s;
                -moz-animation-delay: 1s;
                animation-delay: 1s;
            }
        </style>
    </head>
<body>
    @yield('content')

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>

    @yield('scripts')
</body>
</html>




