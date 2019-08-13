@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.create') !!} {!! trans('site.character') !!} » {!! trans('site.welcome') !!} » <b>{{$user->name}}</b></p>

    @if (session('error'))

        <div id="alerta-time" class="alert alert-danger p-2">
            {!! session('error') !!}
        </div>
    @endif
    @if (isset($errors) && count($errors) > 0)
        <div id="alerta-time" class="alert alert-danger p-2">
            @foreach($errors->all() as $erro)
                <p>{!! $erro !!}</p>

            @endforeach
        </div>
    @endif
@stop

@section('content')
    <div class="top-criar-perso">
        <p><b>{!! trans('site.character') !!}: </b></p>
        <div class="pagination-sm pag">
            {{$create_avatar->links()}}
        </div>
    </div>
    <div class="dados-criar-perso box box-info">
        <form method="POST" action="{{Route('criarP')}}">
            {{ csrf_field() }}
            <div class="input-group form">
                <input id="avatar-select" type="text" hidden name="avatar_select" value="">
                <img src="{{asset('img/personagem/skills_normal.png')}}">
                <input id="id_personagem" type="text" name="nome" class="form-control nome-personagem"
                       placeholder="{!! trans('site.name') !!} {!! trans('site.of') !!} {!! trans('site.character') !!}..." value="{{old('personagem')}}">
                <button type="submit" class="btn btn-outline botao-select botao-criar"
                        title="{!! trans('site.create') !!} {!! trans('site.character') !!}"></button>
            </div>
        </form>

    </div>
    <div class="d-flex flex-row justify-content-sm-center flex-wrap criarP">

        <div class="d-flex flex-row justify-content-sm-center flex-wrap img-avatar">

            @forelse($create_avatar as $avatar)
                <div class="avatar-criarP">
                    {{--<avat class="avat" data-toggle="popover" data-html="true" data-placement="bottom" data-title="{{$avatar->avatar}}" data-content="{{$avatar->descricao}}" data-trigger="click">--}}
                    <div class="img-responsive info-popover popover-avatar" data-toggle="popover" data-html="true"
                         data-placement="right"
                         data-title="{{$avatar->avatar}}" data-content="{{$avatar->descricao}}" data-trigger="click">

                    </div>
                    <img src="{{asset('img/personagem/'.$avatar->avatar.'/face.png')}}" class="img-responsive img-radio"
                         id="{{$avatar->id}}">
                    {{--<input type="button" class="btn btn-radio botao-select" title="Selecionar ' {{$avatar->avatar}}'">--}}

                    <input type="checkbox" id="check-item" hidden class="check-avatar">
                    {{-- </avat>--}}
                </div>

            @empty
                <p>{!! trans('site.none_m') !!} {!! trans('site.character') !!} {!! trans('site.available') !!}...</p>
            @endforelse

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