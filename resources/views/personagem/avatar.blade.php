@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.avatar') !!} » {!! trans("site.welcome") !!} » <b>{{$user->name}}</b></p>
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

    <div class="d-flex flex-row justify-content-sm-center flex-wrap  lista-personagem">
        <div class="d-flex flex-row justify-content-sm-center flex-wrap listAvatar">
            @foreach($avatar_list as $avatar)
                <form method="POST" action="{{url('/updateAvatar')}}">
                    <div hidden><input name="id_avatar" value="{{$avatar->numero_avatar}}"></div>
                    {{ csrf_field() }}
                    @if ($avatar->tipo == 0 && $avatar->status == 0)
                        <div class="avatar-mold-free"></div>
                        <img class="img-free"
                             src="{{asset('img/personagem/'.$avatar_nome.'/avatar-'.$avatar->numero_avatar.'.png')}}">
                        <button id="avatarListID-{{$avatar->id}}" class="btn btn-warning btn-select-avatar-free">
                            Selecionar
                        </button>
                    @elseif($avatar->tipo == 1 && $avatar->status ==0)
                        @if ($vip >0)
                            <div class="avatar-mold-vip"></div>
                            <img class="img-vip"
                                 src="{{asset('img/personagem/'.$avatar_nome.'/avatar-'.$avatar->numero_avatar.'.png')}}">
                            <button id="avatarListID-{{$avatar->id}}" class="btn btn-primary btn-select-avatar-vip">
                                Selecionar
                            </button>

                        @endif
                    @endif


                </form>
            @endforeach
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