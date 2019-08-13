@extends('adminlte::page')

@section('title', 'Sword Art Online(NG)')

@section('status_top')
    <div class="barra-status">
        @foreach($sessao_conta as $char)
            <div style="display: none">
                {{-- Formula barra de hp--}}
                {{$hp_atual = ($char->vida / $char->vida_m)*100}}
                {{$hp_width = (250* $hp_atual)/100}}
                {{-- Formula barra de xp--}}
                {{$exp_atual = ($char->exp / $char->max_exp)*100}}
                {{$exp_width = (250* $exp_atual)/100}}
            </div>
            <div class="hp">
                <div class="hp-color" style="width: {{$hp_width}}px"></div>
                <p class="label-hp">{{$char->vida}}/{{$char->vida_m}}</p>
                <p class="label-hp-p">{{$hp_atual}}%</p>
            </div>
            <div class="exp">
                <div class="exp-color" style="width: {{$exp_width}}px"></div>
                <p class="label-exp">{{$char->exp}}/{{$char->max_exp}}</p>
                <p class="label-exp-p">{{$exp_atual}}%</p>
                @endforeach
            </div>
    </div>
@stop

@section('content_header')
    <p>{!! trans('site.home') !!} » {!! trans('site.welcome') !!} » <b>{{$user->name}}</b></p>
    @if (session('error'))

        <div id="alerta-time" class="alert alert-danger p-2">
            {!! session('error') !!}
        </div>
    @endif

@stop

@section('content')
    <section class="content-banner">
        <!-- Slider Inicio -->
        <div id="wowslider-container1">
            <div class="ws_images">
                <ul>
                    <li>
                        <img src="{{asset('vendor/adminlte/dist/sao_assets/data1/images/img1.jpg')}}"
                             alt="SAO({!! trans('site.publisher') !!})" title="SAO({!! trans('site.publisher') !!})"
                             id="wows1_0"/>Venha
                        fazer parte dessa nova aventura...
                    </li>
                    <li>
                        <img src="{{asset('vendor/adminlte/dist/sao_assets/data1/images/img2.jpg')}}"
                             alt="Beta teste em breve" title="Beta teste em breve" id="wows1_1"/>Não fique de fora...
                    </li>
                    <li>
                        <img src="{{asset('vendor/adminlte/dist/sao_assets/data1/images/img3.jpg')}}"
                             alt="Crie uma Guild ou Junte-se a uma!!!" title="Crie uma Guild ou Junte-se a uma!!!"
                             id="wows1_2"/>Reuna-se com seus amigos!!!
                    </li>
                    <li>
                        <a href="#"><img src="{{asset('vendor/adminlte/dist/sao_assets/data1/images/img4.jpg')}}"
                                         alt="javascript photo gallery" title="Eventos de Abertura do Servidor."
                                         id="wows1_3"/></a>Estaremos lançando diversos eventos junto com a abertura do
                        servidor...
                    </li>
                    <li>
                        <img src="{{asset('vendor/adminlte/dist/sao_assets/data1/images/img5.jpg')}}"
                             alt="Faça parte da nossa equipe!" title="Faça parte da nossa equipe!" id="wows1_4"/>Quer se
                        tornar parte da Staff? entre em contato conosco...
                    </li>
                </ul>
            </div>
            <div class="ws_bullets">
                <div>
                    <a href="#" title="SAO({!! trans('site.publisher') !!})"><span><img
                                    src="{{asset('vendor/adminlte/dist/sao_assets/data1/tooltips/img1.jpg')}}"
                                    alt="SAO({!! trans('site.publisher') !!})"/>1</span></a>
                    <a href="#" title="Beta teste em breve"><span><img
                                    src="{{asset('vendor/adminlte/dist/sao_assets/data1/tooltips/img2.jpg')}}"
                                    alt="Beta teste em breve"/>2</span></a>
                    <a href="#" title="Crie uma Guild ou Junte-se a uma!!!"><span><img
                                    src="{{asset('vendor/adminlte/dist/sao_assets/data1/tooltips/img3.jpg')}}"
                                    alt="Crie uma Guild ou Junte-se a uma!!!"/>3</span></a>
                    <a href="#" title="Eventos de Abertura do Servidor."><span><img
                                    src="{{asset('vendor/adminlte/dist/sao_assets/data1/tooltips/img4.jpg')}}"
                                    alt="Eventos de Abertura do Servidor."/>4</span></a>
                    <a href="#" title="Faça parte da nossa equipe!"><span><img
                                    src="{{asset('vendor/adminlte/dist/sao_assets/data1/tooltips/img5.jpg')}}"
                                    alt="Faça parte da nossa equipe!"/>5</span></a>
                </div>
            </div>
            <div class="ws_shadow"></div>
        </div>
        <!-- Slider fim -->
    </section>
    <section class="content-noticias">
        <div class="noticias-titulo">
            {!!trans('site.news')!!}
            <div class="noticias-anuncio">
                <div class="divi-noti">
                    @forelse ($noticias_anuncios as $anuncio)
                        <ul>

                            <li>
                                <h4>"<b>{{$anuncio->titulo}}</b>"</h4>
                                <h6>{{$anuncio->noticia}}</h6>

                            </li>

                        </ul>
                    @empty
                        {{--  @lang('site.none_f') @lang('site.news') ...--}}
                        {!!trans('site.none_f') .trans('site.news')!!}
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <section class="content-rank">
        <div class="rank-titulo">
            {!!trans('site.rank')!!} {!!trans('site.in')!!} {!!trans('site.player')!!}
        </div>
        <div class="rank-lista">
            <table class="table table-action">
                <thead>
                <tr>
                    <th class="t-small">{!!strtoupper(trans('site.rank'))!!}</th>
                    <th class="t-medium">{!!strtoupper(trans('site.player'))!!}</th>
                    <th class="t-small">{!!strtoupper(trans('site.lvl_full'))!!}</th>
                    <th class="t-medium">{!!strtoupper(trans('site.exp'))!!}</th>
                    <th class="t-medium">{!!strtoupper(trans('site.class'))!!}</th>
                    <th class="t-medium">{!!strtoupper(trans('site.clan'))!!}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rank_level as $rank)
                    <tr>

                        <td class="t-status t-active"><p>{{$posicao++}}º</p></td>
                        <td>{{$rank->nome}}</td>
                        <td> {{$rank->level}}</td>
                        <td>{{$rank->exp}}</td>
                        <td>{{$rank->classe}}</td>
                        <td>{{$rank->sigla}}</td>
                    </tr>
                @empty
                    <td class="t-status t-active"
                        style="text-align: center"> {!! trans('site.none_m') !!} {!! trans('site.character') !!} {!! trans('site.ranking') !!}
                        ...
                    </td>
                @endforelse
                </tbody>

            </table>
        </div>
    </section>
@stop

@section('footer_ng')
    <p style="color: #f0f0f0;float: right;font-size: 12px;right: 2px">
        copyright {!! trans('site.site')!!} ({!!trans('site.publisher')!!}) 2019/2025
        | {!!trans('site.right_m')!!} {!!trans('site.in')!!} {!!trans('site.character')!!}
        ({!!trans('site.img_rights')!!})
    </p>

@stop