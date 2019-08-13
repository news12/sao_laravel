@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.character') !!} » {!! trans("site.welcome") !!} » <b>{{$user->name}}</b></p>
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

    <div class=" modal fade" id="modalExcluir" data-backdrop="static">
        <form method="POST" action="{{url('/excluirP')}}">
            {{method_field('DELETE')}}
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content modal-sao modal-excluir">
                    <div class="modal-header modal-sao-header">
                        <p><b>{!! trans('site.delete') !!} {!! trans('site.character') !!}!</b></p>
                        <input id="id-personagem" hidden name="id_personagem">
                    </div>
                    <div class="modal-body modal-sao-body">
                        <p>{!! trans('txt_lang.msg_delete_character') !!}<b>
                                <h2>
                                    <div id="personagem-excluir"></div>
                                </h2>
                            </b></p>
                    </div>
                    <div class="modal-footer modal-sao-footer">
                        <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                        <button type="submit" class="btn btn-primary">{!! trans('site.delete') !!}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>

    <div class="d-flex flex-row justify-content-sm-center flex-wrap  lista-personagem">
        @foreach($sessao_avatar as $perso)
            <form method="POST">
                {{ csrf_field() }}
                <div hidden>
                    @if ($perso->ativo == 1)
                        {{$avatar_select = 'ativo'}}

                    @else
                        {{$avatar_select = 'passivo'}}
                    @endif
                </div>

                <div class="p-2 flex-fill avatar-personagem {{$avatar_select}}">
                    <div hidden>
                        <label>
                            <input name="id_perso" value="{{$perso->id}}">
                            <input name="nome_perso" value="{{$perso->nome}}">
                        </label>
                    </div>
                    <p id="nome-perso" class="titulo">{!! trans('site.name') !!}:<b>{{$perso->nome}}</b></p>
                    <p class="level"> {!! trans('site.lvl_full') !!}:<b>{{$perso->level}}</b></p>
                    {{--@foreach($avatar as $avatars)--}}
                    <img class="avatar-img" src="{{asset('img/personagem/'.$perso->avatar.'/select.png')}}">
                    {{-- @endforeach--}}
                    <div class="fundo-classe">
                        <p class="classe">{!! trans('site.class') !!}:<b>{{$perso->classe}}</b></p>
                    </div>
                    <div class="fundo-cols">
                        <p class="cols">{!! trans('site.coin') !!}:<b>{{number_format($perso->cols, 2, ',', '.')}}</b>
                        </p>
                    </div>
                    @if ($perso->ativo != 1)
                        <button id="{{$perso->id.'-' .$perso->nome}}" type="button"
                                class="botao-excluir btn btn-outline" title="{!! trans('site.delete') !!}"
                                data-toggle="modal" data-target="#modalExcluir"></button>
                        <button type="submit" class="btn btn-outline botao-select"
                                title="{!! trans('site.select') !!}"></button>


                    @endif

                </div>

            </form>
        @endforeach
    </div>

@stop

@section('footer_ng')
    <p style="color: #f0f0f0;float: right;font-size: 12px;right: 2px">
        copyright {!! trans('site.site')!!} ({!!trans('site.publisher')!!}) 2019/2025
        | {!!trans('site.right_m')!!} {!!trans('site.in')!!} {!!trans('site.character')!!}
        ({!!trans('site.img_rights')!!})
    </p>

@stop