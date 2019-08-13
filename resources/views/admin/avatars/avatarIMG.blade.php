@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('txt_lang.msg_panel_admin_avatars_list') !!} » {!! trans('site.welcome') !!}!!! »
        <b>{{$user->name}}</b></p>
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
    <div class=" modal fade" id="modal-adm-avatarlist-criar" data-backdrop="static">
        <form method="POST" action="{{url('/acAvatarList')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content borda-arredondada">
                    <div class="modal-header">
                        <p><b><h4> {!! trans('site.avatar') !!}!</h4></b></p>
                    </div>
                    <div class="modal-body">
                        <label for="img-item-avatar">
                            <div class="uploadFile">IMG AVATAR:
                                <input id="uploadAvatar"
                                       placeholder="Selecione a imagem"
                                       disabled="disabled" class="input-img-avatar"/>
                            </div>
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input id="imgAvatar" name="img_avatar"
                                       type="file"
                                       class="upload img-avatar-create"/>
                            </div>

                            <div class="form-group">
                                <label for="id-avatar">{{trans('site.id')}} {{trans('site.avatar')}}:
                                    <input name="id_avatar" type="text"
                                           class="form-control form-expandido borda-arredondada"
                                           id="id_avatar-criar"
                                           value="">
                                </label>
                                <label for="numeroAvatar">{{trans('site.number')}} {{trans('site.avatar')}}
                                    :
                                    <input name="numero_avatar" type="text"
                                           class="form-control form-expandido borda-arredondada"
                                           id="numeroAvatar"
                                           value="1">
                                </label>
                                <label for="tipo">{{trans('site.type')}}:
                                    <select id="tipo" name="tipo"
                                            class="form-control">
                                        <option value="0">Free</option>
                                        <option value="1">Vip</option>
                                        <option value="2">Evento</option>
                                        <option value="3">Premio</option>

                                    </select>
                                </label>

                                <label for="tipo">{{trans('site.type')}}:
                                    <select id="status" name="status"
                                            class="form-control">
                                        <option value="0">Disponivel</option>
                                        <option value="1">Indisponivel</option>

                                    </select>
                                </label>
                            </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default pull-left btn-cancel-avatarlist"
                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                        <button id="submit-avatar" type="submit"
                                class="btn btn-primary btn-create-avatar">{!! trans('site.create') !!}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>

    <div class="d-flex flex-row justify-content-sm-center flex-wrap row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{strtoupper(trans('site.img'))}} {{strtoupper(trans('site.avatar'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-adm-avatarlist-criar"
                            class="btn btn-success btn-new-avatar">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-avatar-sao">
                    <table id="lista-avatar"

                           class="table table-bordered table-responsive table-hover table-panel-avatar">

                        <thead>
                        <tr class="titulo">
                            <th>ID:</th>
                            <th>{{strtoupper(trans('site.name'))}}:</th>
                            <th>{{strtoupper(trans('site.type'))}}:</th>
                            <th>{{strtoupper(trans('site.number'))}}-{{strtoupper(trans('site.avatar'))}}:</th>
                            <th>{{strtoupper(trans('site.img'))}}-{{strtoupper(trans('site.avatar'))}}:</th>
                            <th>{{strtoupper(trans('site.id'))}}-{{strtoupper(trans('site.avatar'))}}:</th>
                            <th>{{strtoupper(trans('site.status'))}}:</th>
                            <th>{{strtoupper(trans('site.action'))}}:</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($avatars as $avatar)
                            <div class=" modal fade" id="modal-adm-avatarList-{{$avatar->id}}" data-backdrop="static">
                                <form method="POST" action="{{url('/aeAvatarList')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content borda-arredondada">
                                            <div class="modal-header">
                                                <p><b><h4> {!! trans('site.avatar') !!}!</h4></b></p>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="id">{{trans('site.id')}}:
                                                        <input name="id_avatar" readonly type="text"
                                                               id="id-{{$avatar->id}}"
                                                               class="form-control form-expandido borda-arredondada"
                                                               value="{{$avatar->id}}">
                                                    </label>
                                                    <label for="img-avatar">
                                                        <div class="uploadFile">IMG AVATAR:
                                                            <input id="uploadAvatar-{{$avatar->id}}"
                                                                   placeholder="Selecione a imagem"
                                                                   disabled="disabled" class="input-img-avatar"/>
                                                        </div>
                                                        <div class="fileUpload btn btn-primary">
                                                            <span>Upload</span>
                                                            <input id="imgAvatar-{{$avatar->id}}" name="img_avatar"
                                                                   type="file"
                                                                   class="upload img-avatar-edit"/>
                                                        </div>
                                                    </label>

                                                    <label for="idAvatar">{{trans('site.id')}}{{trans('site.avatar')}}:
                                                        <input name="id_avatar" type="text"
                                                               class="form-control form-expandido borda-arredondada"
                                                               id="idAvatar-{{$avatar->id}}"
                                                               value="{{$avatar->id_avatar}}">
                                                    </label>

                                                    <label for="numero-avatar">{{trans('site.number')}} {{trans('site.avatar')}}
                                                        :
                                                        <input name="numero_avatar" type="text"
                                                               class="form-control form-expandido borda-arredondada"
                                                               id="numeroAvatar-{{$avatar->id}}"
                                                               value="{{$avatar->numero_avatar}}">
                                                    </label>
                                                    <label for="status">{{trans('site.status')}}:
                                                        <select id="status-{{$avatar->id}}" name="status"
                                                                class="form-control"
                                                                style="float: left;position: relative">

                                                            @if ($avatar->status == 0)
                                                                <option selected
                                                                        value="{{$avatar->status}}">Disponivel
                                                                </option>
                                                            @else
                                                                <option value="0">Disponivel</option>
                                                            @endif

                                                            @if($avatar->status == 1)
                                                                <option selected
                                                                        value="{{$avatar->status}}">Indisponivel
                                                                </option>
                                                            @else
                                                                <option value="1">Indesponivel</option>
                                                            @endif

                                                        </select>
                                                    </label>
                                                    <label for="tipo">{{trans('site.type')}}:
                                                        <select id="tipo-{{$avatar->id}}" name="tipo"
                                                                class="form-control"
                                                                style="float: left;position: relative">

                                                            @if ($avatar->tipo == 0)
                                                                <option selected
                                                                        value="{{$avatar->tipo}}">Free
                                                                </option>
                                                            @else
                                                                <option value="0">Free</option>
                                                            @endif

                                                            @if($avatar->tipo == 1)
                                                                <option selected
                                                                        value="{{$avatar->tipo}}">Vip
                                                                </option>
                                                            @else
                                                                <option value="1">Vip</option>
                                                            @endif

                                                            @if($avatar->tipo == 2)
                                                                <option selected
                                                                        value="{{$avatar->tipo}}">Evento
                                                                </option>
                                                            @else
                                                                <option value="2">Evento</option>
                                                            @endif

                                                            @if($avatar->tipo == 3)
                                                                <option selected
                                                                        value="{{$avatar->tipo}}">Premio
                                                                </option>
                                                            @else
                                                                <option value="3">Premio</option>
                                                            @endif


                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button"
                                                        class="btn btn-default pull-left btn-cancel-avatarlist"
                                                        data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                <button id="idsubmit-{{$avatar->id}}" type="submit"
                                                        class="btn btn-primary btn-save-avatar">{!! trans('site.save') !!}</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form>
                            </div>


                            <tr class="text">
                                <div hidden>
                                    @if ($avatar->tipo == 0)
                                        {{$tipo_nome = 'Free'}}
                                    @elseif($avatar->tipo == 1)
                                        {{$tipo_nome = 'Vip'}}
                                    @elseif($avatar->tipo == 2)
                                        {{$tipo_nome = 'Evento'}}
                                    @elseif($avatar->tipo == 3)
                                        {{$tipo_nome = 'Premio'}}
                                    @else
                                        {{$tipo_nome = 'Indefinido'}}
                                    @endif

                                    @if ($avatar->status ==0)
                                        {{$status_nome = 'Disponivel'}}
                                    @else
                                        {{$status_nome = 'Indisponivel'}}

                                    @endif
                                </div>
                                <td>{{$avatar->id}}</td>
                                <td>{{ $avatar->avatar }}</td>
                                <td>{{$tipo_nome}}</td>
                                <td>{{ $avatar->numero_avatar }}</td>
                                <td><img class="avatars-img"
                                         src="{{asset('img/personagem/'.$avatar->avatar.'/avatar-'.$avatar->numero_avatar.'.png')}}">
                                </td>
                                <td>{{$avatar->id_avatar}}</td>
                                <td>{{$status_nome}}</td>
                                <td>

                                    <button type="submit"
                                            class="btn btn-warning glyphicon glyphicon-pencil edit-adm-avatar"
                                            title="{{trans('site.edit')}} {{trans('site.news')}}"
                                            data-toggle="modal"
                                            data-target="#modal-adm-avatarList-{{$avatar->id}}">
                                        <p>{{trans('site.edit')}}</p></button>
                                    <form method="POST" action="{{url('/adAvatarList')}}">
                                        {{csrf_field()}}
                                        <input hidden name="delete_img_avatar" id="delete-id-avatar"
                                               value="{{$avatar->id}}">
                                        <button id="iddel-{{$avatar->id}}" type="submit"
                                                class="btn btn-danger glyphicon glyphicon-remove excluir-adm-avatar"
                                                title="{{trans('site.delete')}} {{trans('site.avatar')}}">
                                            <p>{{trans('site.delete')}}</p></button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <td> {!! trans('site.none_f') !!} {!! trans('site.news') !!} {!! trans('site.found_f') !!}
                                ...
                            </td>
                        @endforelse

                        </tbody>

                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@stop

@section('footer_ng')
    <p style="color: #f0f0f0;float: right;font-size: 12px;right: 2px">
        copyright {!! trans('site.site')!!} ({!!trans('site.publisher')!!}) 2019/2025
        | {!!trans('site.right_m')!!} {!!trans('site.in')!!} {!!trans('site.character')!!}
        ({!!trans('site.img_rights')!!})
    </p>

@stop