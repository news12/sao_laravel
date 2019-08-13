@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.floor') !!} {{$andar_atual}}º » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
    @if (session('success'))

        <div id="alerta-time" class="alert alert-success p-2">
            {!! session('success') !!}
        </div>
    @endif
    @if (session('error'))

        <div id="alerta-time" class="alert alert-danger p-2">
            {!! session('error') !!}
        </div>
    @endif
@stop

@section('content')

    <div class="andar">
        <div class="title-andar">
            <h4>{{trans('txt_lang.msg_floor_welcome')}} » {{$andar_atual}}º</h4>
        </div>

        <div class="content-andar">
            <p>Mapas Disponíveis no Andar:</p>
            <div class="bd-example bd-example-tabs">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach($mapa as $mapas)
                        @if ($mapas->order_map ==1)
                            <li class="nav-item">
                                <a class="nav-link active show" id="pills-{{$mapas->name_unic}}-tab" data-toggle="pill"
                                   href="#pills-{{$mapas->name_unic}}"
                                   role="tab" aria-controls="pills-{{$mapas->name_unic}}"
                                   aria-selected="true">{{$mapas->nome}}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" id="pills-{{$mapas->name_unic}}-tab" data-toggle="pill"
                                   href="#pills-{{$mapas->name_unic}}"
                                   role="tab" aria-controls="pills-{{$mapas->name_unic}}"
                                   aria-selected="false">{{$mapas->nome}}</a>
                            </li>
                        @endif
                    @endforeach

                </ul>
                <div class="tab-content d-flex flex-row justify-content-sm-center flex-wrap" id="pills-tabContent">
                    @foreach($mapa as $mapas)
                        @if ($mapas->order_map ==1)
                            <div class="tab-pane fade active show " id="pills-{{$mapas->name_unic}}" role="tabpanel"
                                 aria-labelledby="pills-{{$mapas->name_unic}}-tab">

                                <p>Dados do Mapa: {{$mapas->nome}}</p>
                            </div>
                        @else
                            <div class="tab-pane fade" id="pills-{{$mapas->name_unic}}" role="tabpanel"
                                 aria-labelledby="pills-{{$mapas->name_unic}}-tab">

                                <p>Dados do Mapa: {{$mapas->nome}}</p>

                            </div>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>


@stop

@section('footer_ng')
    <p style="color: #f0f0f0;float: right;font-size: 12px;right: 2px">
        copyright {!! trans('site.site')!!} ({!!trans('site.publisher')!!}) 2019/2025
        | {!!trans('site.right_m')!!} {!!trans('site.in')!!} {!!trans('site.character')!!}
        ({!!trans('site.img_rights')!!})
    </p>

@stop