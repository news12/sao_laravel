@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.css')}} ">
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/sao_ng.css') }}">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
   {{-- <div id="element" class="introLoading"></div>--}}
  {{-- <div class="loadingContent loadingCentre"> <img src="{{asset('img/gears.gif')}}">
       <div id="loadingBar"></div>
       <div id="loadingText">Carregando jogo aguarde..</div>
   </div>--}}
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                @else
                    <!-- Logo -->
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                            <!-- mini logo for sidebar mini 50x50 pixels -->
                            <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                        </a>

                </nav>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="navbar-minimalize minimalize-styl-2 btn btn-cursor-sao" data-toggle="push-menu"
                       role="button">
                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
                    {{-- status top--}}
                    <div class="barra-status">
                        @foreach($sessao_conta as $char)
                            <div style="display: none">
                                {{-- Formula barra de hp--}}
                                {{$hp_atual = ($char->vida / $char->vida_m)*100}}
                                {{$hp_width = (250* $hp_atual)/100}}
                                {{-- Formula barra de xp--}}
                                {{$exp_atual = ($char->exp / $char->max_exp)*100}}
                                {{$exp_width = (250* $exp_atual)/100}}
                                @if ($level_up_show == 'on')
                                    <div id="ativa-level_up">on</div>
                                    {{$level_up_show = 'off'}}
                                @endif

                            </div>
                            {{-- Inicio Modal Level Up--}}
                            <div class=" modal fade" id="modalLevelUp" data-backdrop="static">
                                <div class="modal-dialog">
                                    <div class="modal-content modal-sao modal-levelup">
                                        <div class="modal-header modal-sao-header">
                                            <p><b>Congratulations!</b></p>
                                        </div>
                                        <div class="modal-body modal-sao-body">
                                            <p><h5>Parabens!!, você evoluiu para:</h5><br>
                                            <b class="levelUpText">Lvl.{{$new_level}}<br></b>
                                            </p>
                                        </div>
                                        <div class="modal-footer modal-sao-footer modal-footer-levelup">
                                            <button type="button" class="btn btn-outline botao-select"
                                                    data-dismiss="modal" title="Voltar"></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            {{-- Fim Modal Level Up--}}
                            <div class="hp">
                                <div class="hp-color" style="width: {{$hp_width}}px"></div>
                                <p class="label-hp">{{$char->vida}}/{{$char->vida_m}}</p>
                                <p class="label-hp-p">{{number_format($hp_atual)}}%</p>
                            </div>
                            <div class="exp">
                                <div class="exp-color" style="width: {{$exp_width}}px"></div>
                                <p class="label-exp">{{$char->exp}}/{{$char->max_exp}}</p>
                                <p class="label-exp-p">{{number_format($exp_atual)}}%</p>
                                @endforeach
                            </div>


                            @endif
                        <!-- Navbar Right Menu -->
                            <div class="navbar-custom-menu">

                                <ul class="nav navbar-nav">
                                    <li>
                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                        @else
                                            <a href="#"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                            <form id="logout-form"
                                                  action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"
                                                  method="POST" style="display: none;">
                                                @if(config('adminlte.logout_method'))
                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                @endif
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <div class="avatar-top">
                        @forelse($sessao_conta as $conta)
                            @forelse($avatar as $avatars)
                             {{--   <img class="img-n avatar-mold" src="{{asset('img/personagem/avatar-mold.png')}}">--}}
                                <img class="img-n avatar-img"
                                     src="{{asset('img/personagem/'.$avatars->avatar.'/avatar-'.$avatars->img_avatar.'.png')}}">

                                <img class="img-m avatar-mold" src="{{asset('img/personagem/avatar-mold.png')}}">
                                <img class="img-m avatar-img"
                                     src="{{asset('img/personagem/'.$avatars->avatar.'/avatar-'.$avatars->img_avatar.'.png')}}">
                                <div class="img-m"><b class="personagem">{{$avatars->avatar}}</b></div>
                                {{--  <div class="status-perso" >--}}
                                <div class="dropdown profile-element">
                                    <a href="{{'/indexAvatar'}}" title="Mudar Avatar!!!"><img class="status-perso" src="{{asset('img/appearance_normal.png')}}"></a>
                                    {{--</div>--}}
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="text-muted text-xs block"> <strong id="nomeAvatar"
                                                                                                 class="font-bold"></strong>
                             </span> <span class="text-muted text-xs block">Status <b class="caret"></b></span> </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs drop-status">
                                        <li>Bonus Vip</li>
                                        <li class="divider"></li>
                                        <li>Bonus Evento</li>
                                        <li class="divider"></li>
                                        <li>Bonus Classe</li>
                                        <li class="divider"></li>
                                        <li><a href="#">Outros</a></li>
                                    </ul>
                                </div>
                            @empty

                                <img class="img-n" src="{{asset('img/personagem/no-avatar.png')}}">
                                <img class="img-m" src="{{asset('img/personagem/no-avatar.png')}}">
                            @endforelse
                        @empty
                            <img class="img-n" src="{{asset('personagem')}}">
                            <img class="img-m" src="{{asset('personagem')}}">
                        @endforelse
                        <div class="info-avatar">
                            @forelse($sessao_conta as $char)
                                <div class="avatar-status">
                                    <p class="per">Player: <b> {{$char->nome}}</b></p>
                                    <p class="lvl">Level: <b> {{$char->level}}</b></p>
                                    <p class="cols">Cols: <b> {{number_format($char->cols,2,',','.')}}</b></p>
                                    <p class="classe">Classe: <b> {{$char->classe}}</b></p>
                                    <p class="per">Poder: <b>{{number_format($power,2,',','.')}}</b></p>

                                </div>
                            @empty
                                <div class="avatar-status">
                                    <p>Nenhum personagem selecionado</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class=" flex-fill content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="p-2 flex-fill container">
                @endif
                <!-- Noticia chat -->
                    <section class="p-2 flex-fill noticia-chat">
                        <div class="mega-fone">
                            {{--<img src="{{ asset('img/megaphone100.png') }}">--}}
                        </div>
                        <p class="">
                            <marquee direction="right">
                                @forelse ($noticias as $noti)

                                    <b>Por: </b>{{$noti->player}}<b> MSG: </b>{{$noti->texto}}
                                @empty
                                    Nenhuma Noticia encontrada...
                                @endforelse
                            </marquee>
                        </p>
                    </section>
                    <!-- Content Header (Page header) -->
                    <section class="p-2 flex-fill content-header">

                        @yield('content_header')
                    </section>


                    <!-- Main content -->
                    <section class="d-flex justify-content-sm-center flex-wrap content">

                    @yield('content','Conteudo Home')

                    {{-- <section class="content-noticias">
                         @yield('content_noticias', 'Noticias')
                     </section>
                     <section class="content-rank">
                         @yield('content_rank', 'Rank')
                     </section>
                 </section>--}}
                    <!-- /.content -->
                    </section>
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

        <div class="footer">
            @yield('footer_ng', 'Footer')
        </div>

    </div>

    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    {{-- <script src="{{asset('vendor/adminlte/dist/sao_assets/demo.js')}}"></script>--}}
    {{--    <script src="{{asset('vendor/adminlte/dist/sao_assets/engine1/jquery.js')}}"></script>--}}
    <script src="{{asset('vendor/adminlte/dist/sao_assets/engine1/wowslider.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/sao_assets/engine1/script.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/sao_assets/sao.js')}}"></script>
    <script src="{{asset('vendor/adminlte/dist/sao_assets/ajax_sao.js')}}"></script>

    {{--<script src="{{asset('vendor/adminlte/dist/sao_assets/popover.js')}}"></script>
   <script src="{{asset('vendor/adminlte/dist/sao_assets/bootbox.min.js')}}"></script>--}}

    @stack('js')
    @yield('js')
@stop
