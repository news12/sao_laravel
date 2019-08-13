<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/jquery.webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Banner -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/engine1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/engine1/style.mod.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.css')}} ">
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/sao_ng.css') }}">
</head>
<body class="antialiased font-sans">
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="text-center">
                        <span class="glyphicon" aria-hidden="true"></span><img src="{{asset('img/Chibi_erro.png')}}">
                        Oops:
                        <small> @yield('code', __('Ah não'))</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <p>Ocorreu o seguinte erro:</p>

                    <ul class="list-group">
                        <li class="list-group-item"> @yield('message')</li>
                        <li class="list-group-item">Se você chegou a esta página clicando em um link,
                            <a href="http://newsgames.com.br"><b>contate-nos</b></a>
                        </li>
                        <li class="list-group-item">Clique aqui para:  <a href="{{ url('/home') }}">
                                <button class="btn btn-primary">
                                    {{ __('Ir para Home') }}
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p><a href="https://newsgames.com.br" target="_blank">NewsGames.</a></p>
        </div>
        <div class="col-md-2">

        </div>
    </div>


</div>
</body>
</html>
