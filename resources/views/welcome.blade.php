<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sao(NG)</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
              /*  background-color: #000000;*/
             /*   background-image: url("/layouts/img/sao_fundo.jpg");*/
                background-image: url({{ URL::asset('img/sao_fundo.jpg')}});
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                left: 1px;
                height: 25px;
                top: 1px;
                width: 320px;
                background-color: #ffffff;
                opacity: 0.9;
                z-index: auto;
            }

            .content {
                text-align: center;
                margin-top: 20px;
               /* opacity: 0.5;*/
            }

            .title {
               /* font-size: 80px;*/
                color: #ffffff;
                background-image: url({{ URL::asset('img/sao_logo2.png')}});
                width: 375px;
                margin-left: 100px;
                margin-top: 60px;
                height: 280px;
                opacity: 0.7;
            }

            .links > a {
                color: #ffffff;
                padding: 10px 25px;
                font-size: 14px;
                font-family: 'Tahoma', Arial, Verdana, Sans-Serif, serif;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: #2b2b2b;
                text-align: center;
                margin-left: 10px;
                text-transform: uppercase;

            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .menuFixo {
                position: fixed;
                right: 0;
                top: 50%;
                width: 8em;
                margin-top: -2.5em;
                background-color: white;
            }
            .menuFixo  a {
                color: #f0ad4e;
                text-decoration: none;
            }
            .menuFixo ul li {
               border-bottom: 1px #f0ad4e;
            }
            div.banner {
                margin: 0;
                font-size: 100% /*smaller*/;
                font-weight: bold;
                line-height: 1.1;
                text-align: center;
                position: fixed;
                bottom: 0.1em;
                left: auto;
                width: 8.5em;
                right: 2em;
            }
            div.banner p {
                margin: 0;
                padding: 0.3em 0.4em;
                font-family: Arial, sans-serif;
                background: #f0ad4e;
                border: thin outset #f0ad4e;
                color: white;
                opacity: 0.8;
            }

            div.banner a, div.banner em { display: block; margin: 0 0.5em }
            div.banner a, div.banner em { border-top: 2px groove #900 }
            div.banner a:first-child { border-top: none }
            div.banner em { color: #f0ad4e }

            div.banner a:link { text-decoration: none; color: white }
            div.banner a:visited { text-decoration: none; color: white }
            div.banner a:hover { background: #f7bc60; color: white }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="banner">

                    @auth
                        <p> <a href="{{ url('/home') }}">Home</a></p>
                    @else
                        <p><a href="{{ route('login') }}">Logar</a></p>

                        @if (Route::has('register'))
                           <p> <a href="{{ route('register') }}">Criar</a></p>
                        @endif
                    @endauth

                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{--Sword Art Online (NG)--}}
                </div>

                <div class="links">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/LgUcDFUgNiY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </body>
</html>
