@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('txt_lang.msg_panel_admin_avatars') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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
    <div class=" modal fade" id="modal-adm-avatar-criar" data-backdrop="static">
        <form method="POST" action="{{url('/acAvatar')}}" enctype="multipart/form-data">
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
                        </label>
                        <label for="img-item-face">
                            <div class="uploadFile">IMG FACE:
                                <input id="uploadFace"
                                       placeholder="Selecione a imagem"
                                       disabled="disabled" class="input-img-face"/>
                            </div>
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input id="imgFace" name="img_face"
                                       type="file"
                                       class="upload img-face-create"/>
                            </div>
                        </label>
                        <label for="img-item-avatar">
                            <div class="uploadFile">IMG Select:
                                <input id="uploadSelect"
                                       placeholder="Selecione a imagem"
                                       disabled="disabled" class="input-img-select"/>
                            </div>
                            <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input id="imgSelect" name="img_select"
                                       type="file"
                                       class="upload img-select-create"/>
                            </div>
                        </label>
                        <div class="form-group">
                            <label for="avatar">{{trans('site.name')}}:
                                <input name="avatar" type="text"
                                       class="form-control form-expandido borda-arredondada"
                                       id="avatar-criar"
                                       value="">
                            </label>
                            <label for="numero-avatar">{{trans('site.number')}} {{trans('site.avatar')}}
                                :
                                <input name="numero_avatar" type="text"
                                       class="form-control form-expandido borda-arredondada"
                                       id="numeroAvatar"
                                       value="1">
                            </label>
                            <label for="descricao">{{trans('site.desc')}}:
                                <textarea name="descricao"
                                          class="form-control form-expandido area-text borda-arredondada"
                                          id="descricao-criar"
                                          rows="5">

                            </textarea>
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
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default pull-left btn-cancel-avatar"
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
                    <h3 class="box-title">{{strtoupper(trans('site.avatar'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-adm-avatar-criar"
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
                            <th>{{strtoupper(trans('site.desc'))}}:</th>
                            <th>{{strtoupper(trans('site.img'))}}-{{strtoupper(trans('site.avatar'))}}:</th>
                            <th>{{strtoupper(trans('site.img'))}}-{{strtoupper(trans('site.face'))}}:</th>
                            <th>{{strtoupper(trans('site.img'))}}-{{strtoupper(trans('site.select'))}}:</th>
                            <th>{{strtoupper(trans('site.action'))}}:</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($avatars as $avatar)
                            <div class=" modal fade" id="modal-adm-avatar-{{$avatar->id}}" data-backdrop="static">
                                <form method="POST" action="{{url('/aeAvatar')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content borda-arredondada">
                                            <div class="modal-header">
                                                <p><b><h4> {!! trans('site.avatar') !!}!</h4></b></p>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="id_avatar">{{trans('site.id')}}:
                                                        <input name="id_avatar" readonly type="text"
                                                               id="id-avatar-{{$avatar->id}}"
                                                               class="form-control form-expandido borda-arredondada"
                                                               value="{{$avatar->id}}">
                                                    </label>
                                                    <label for="img-item-avatar">
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
                                                    <label for="img-item-face">
                                                        <div class="uploadFile">IMG FACE:
                                                            <input id="uploadFace-{{$avatar->id}}"
                                                                   placeholder="Selecione a imagem"
                                                                   disabled="disabled" class="input-img-face"/>
                                                        </div>
                                                        <div class="fileUpload btn btn-primary">
                                                            <span>Upload</span>
                                                            <input id="imgFace-{{$avatar->id}}" name="img_face"
                                                                   type="file"
                                                                   class="upload img-face-edit"/>
                                                        </div>
                                                    </label>
                                                    <label for="img-item-avatar">
                                                        <div class="uploadFile">IMG Select:
                                                            <input id="uploadSelect-{{$avatar->id}}"
                                                                   placeholder="Selecione a imagem"
                                                                   disabled="disabled" class="input-img-select"/>
                                                        </div>
                                                        <div class="fileUpload btn btn-primary">
                                                            <span>Upload</span>
                                                            <input id="imgSelect-{{$avatar->id}}" name="img_select"
                                                                   type="file"
                                                                   class="upload img-select-edit"/>
                                                        </div>
                                                    </label>
                                                    <label for="Avatar">{{trans('site.name')}}:
                                                        <input name="avatar" type="text"
                                                               class="form-control form-expandido borda-arredondada"
                                                               id="avatar-{{$avatar->id}}"
                                                               value="{{$avatar->avatar}}">
                                                    </label>
                                                    <label for="descricao">{{trans('site.desc')}}:
                                                        <textarea name="descricao"
                                                                  class="form-control form-expandido area-text borda-arredondada"
                                                                  id="descricao-{{$avatar->id}}"
                                                                  rows="5">
{{$avatar->descricao}}
                                                    </textarea>
                                                    </label>
                                                    <label for="tipo">{{trans('site.type')}}:
                                                        <select id="tipo-{{$avatar->id}}" name="tipo"
                                                                class="form-control">

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
                                                    <label for="numero-avatar">{{trans('site.number')}} {{trans('site.avatar')}}
                                                        :
                                                        <input name="numero_avatar" type="text"
                                                               class="form-control form-expandido borda-arredondada"
                                                               id="numeroAvatar-{{$avatar->id}}"
                                                               value="1">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button"
                                                        class="btn btn-default pull-left btn-cancel-avatar"
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
                                </div>
                                <td>{{$avatar->id}}</td>
                                <td>{{ $avatar->avatar }}</td>
                                <td>{{$tipo_nome}}</td>
                                <td>{{ $avatar->descricao }}</td>
                                <td><img class="avatars-img"
                                         src="{{asset('img/personagem/'.$avatar->avatar.'/avatar-1.png')}}"></td>
                                <td><img class="avatars-img"
                                         src="{{asset('img/personagem/'.$avatar->avatar.'/face.png')}}"></td>
                                <td><img class="avatars-img"
                                         src="{{asset('img/personagem/'.$avatar->avatar.'/select.png')}}"></td>
                                <td>
                                    {{-- <form method="POST" action="{{url('/adNoticia')}}">
                                         {{csrf_field()}}
                                         <div hidden>
                                             <input id="id-noticia"name="id_noticia" value="{{$noticia->id}}">
                                         </div>--}}
                                    <button type="submit"
                                            class="btn btn-warning glyphicon glyphicon-pencil edit-adm-avatar"
                                            title="{{trans('site.edit')}} {{trans('site.news')}}"
                                            data-toggle="modal"
                                            data-target="#modal-adm-avatar-{{$avatar->id}}">
                                        <p>{{trans('site.edit')}}</p></button>
                                    <form method="POST" action="{{url('/adAvatar')}}">
                                        {{csrf_field()}}
                                        <input hidden name="delete_id_avatar" id="delete-id-avatar"
                                               value="{{$avatar->id}}">
                                        <button id="iddel-{{$avatar->id}}" type="submit"
                                                class="btn btn-danger glyphicon glyphicon-remove excluir-adm-avatar"
                                                title="{{trans('site.delete')}} {{trans('site.avatar')}}">
                                            <p>{{trans('site.delete')}}</p></button>
                                    </form>
                                    {{--</form>--}}
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