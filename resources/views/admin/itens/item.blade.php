@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('txt_lang.msg_panel_admin_items') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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
    <div class=" modal fade" id="modal-criar-item" data-backdrop="static">
        <form method="POST" action="{{url('/acItem')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content borda-arredondada">
                    <div class="modal-header">
                        <p><b><h4> {!! trans('site.item') !!}!</h4></b></p>
                    </div>
                    <div class="modal-body modal-adm-itens">
                        <div class="form-group">
                            <label for="img-item">
                                <div class="uploadFile">IMG:
                                    <input id="uploadFile" placeholder="Selecione a imagem" disabled="disabled"/>
                                </div>
                                <div class="fileUpload btn btn-primary">
                                    <span>Upload</span>
                                    <input id="img-item" name="img_item" type="file" class="upload"/>
                                </div>
                            </label>
                            <label for="nome">{{trans('site.name')}}:
                                <input name="nome" type="text" placeholder="nome do item..."
                                       class="form-control form-expandido borda-arredondada"
                                       id="nome"
                                       value="">
                            </label>
                            <label for="descricao">{{trans('site.desc')}}:
                                <textarea name="descricao" placeholder="descrição do item..."
                                          class="form-control form-expandido area-text borda-arredondada"
                                          id="descricao"
                                          rows="5">

                                                    </textarea>
                            </label>
                            <div class="well well-lg well-status">
                                <label for="level">{{trans('site.lvl_full')}}:
                                    <input name="level" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="level"
                                           value="1">
                                </label>
                                <label for="for">{{trans('site.attr_str_full')}}:
                                    <input name="for" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="for"
                                           value="0">
                                </label>
                                <label for="int">{{trans('site.attr_int_full')}}:
                                    <input name="int" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="int"
                                           value="0">
                                </label>
                                <label for="agi">{{trans('site.attr_agi_full')}}:
                                    <input name="agi" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="agi"
                                           value="0">
                                </label>
                                <label for="def">{{trans('site.attr_def_full')}}:
                                    <input name="def" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="def"
                                           value="0">
                                </label>
                                <label for="res">{{trans('site.attr_res_full')}}:
                                    <input name="res" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="res"
                                           value="0">
                                </label>
                                <label for="esp">{{trans('site.attr_swo_full')}}:
                                    <input name="esp" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="esp"
                                           value="0">
                                </label>
                                <label for="evo">{{trans('site.attr_evo_full')}}:
                                    <input name="evo" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="evo"
                                           value="0">
                                </label>
                                <label for="mag">{{trans('site.attr_mag_full')}}:
                                    <input name="mag" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="mag"
                                           value="0">
                                </label>
                                <label for="energia">{{trans('site.energy')}}:
                                    <input name="energia" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="energia"
                                           value="0">
                                </label>
                                <label for="vida">{{trans('site.attr_vit_full')}}:
                                    <input name="vida" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="vida"
                                           value="0">
                                </label>
                                <label for="cols">{{trans('site.coin')}}:
                                    <input name="cols" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="cols"
                                           value="0">
                                </label>
                                <label for="cash">{{trans('site.cash')}}:
                                    <input name="cash" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="cash"
                                           value="0">
                                </label>
                                <label for="data-inicio">{{trans('site.date')}} {{trans('site.prime')}}
                                    :
                                    <input name="data_inicio" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="data-inicio"
                                           value="">
                                </label>
                                <label for="data-fim">{{trans('site.date')}} {{trans('site.end')}}:
                                    <input name="data_fim" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="data-fim"
                                           value="">
                                </label>

                            </div>
                            <label for="id-avatar">{{trans('site.id')}} {{trans('site.avatar')}}:
                                <input name="id_avatar" type="text" placeholder="numero,nome da imagem"
                                       class="form-control label-mini borda-arredondada"
                                       id="id-avatar"
                                       value="">
                            </label>

                            <label for="classe">{{trans('site.class')}}:
                                <select id="id-classe" name="id_classe"
                                        class="form-control">
                                    <option value="99">Todas</option>
                                    @foreach($classes as $classe)

                                        <option value="{{$classe->id}}">{{$classe->classe}}</option>

                                    @endforeach
                                </select>
                            </label>

                            <label for="id-grau-item">{{trans('site.grade')}}:
                                <select id="id-grau-item" name="id_grau_item"
                                        class="form-control">
                                    {{--<option>Nenhum</option>--}}
                                    @foreach($grauItem as $grau)

                                        <option value="{{$grau->id}}">{{$grau->nome}}</option>

                                    @endforeach
                                </select>
                            </label>

                            <label for="id-tipo-item">{{trans('site.type')}}:
                                <select id="id-tipo-item" name="id_tipo_item"
                                        class="form-control">
                                    {{--<option>Nenhum</option>--}}
                                    @foreach($tipoItem as $tipo)

                                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>

                                    @endforeach
                                </select>
                            </label>

                            <label for="id-tipo-drop">{{trans('site.drop')}}:
                                <select id="id-tipo-drop" name="id_tipo_drop"
                                        class="form-control">
                                    {{-- <option>Nenhum</option>--}}
                                    @foreach($tipoDrop as $drop)

                                        <option value="{{$drop->id}}">{{$drop->nome}}</option>

                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                        <button id="idsubmit-new-item" type="submit"
                                class="btn btn-primary btn-create-item">{!! trans('site.create') !!}</button>
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
                    <h3 class="box-title">{{strtoupper(trans('site.item'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-criar-item"
                            class="btn btn-success btn-new-noticia">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-noticia-sao">
                    <table id="lista-itens"

                           class="table table-bordered table-responsive table-hover table-panel-noticias">

                        <thead>
                        <tr class="titulo">
                            <th>Img:</th>
                            <th>ID:</th>
                            <th>{{strtoupper(trans('site.name'))}}:</th>
                            <th>{{strtoupper(trans('site.desc'))}}:</th>
                            <th>{{strtoupper(trans('site.lvl_full'))}}:</th>
                            <th>{{strtoupper(trans('site.class'))}}:</th>
                            <th>{{strtoupper(trans('site.coin'))}}:</th>
                            <th>{{strtoupper(trans('site.grade'))}}</th>

                            {{--ação--}}
                            <th>{{strtoupper(trans('site.action'))}}:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($itens as $item)
                            <div class=" modal fade" id="modal-adm-item-{{$item->id}}" data-backdrop="static">
                                <form method="POST" id="form-edit-item" action="{{url('/aeItem')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content borda-arredondada">
                                        <div class="modal-header">
                                            <p><b><h4> {!! trans('site.item') !!}!</h4></b></p>
                                        </div>
                                        <div class="modal-body modal-adm-itens">
                                            <div class="form-group">
                                                <label for="img-item">
                                                    <div class="uploadFile">IMG:
                                                        <input id="uploadFile-{{$item->id}}" placeholder="Selecione a imagem"
                                                               disabled="disabled"/>
                                                    </div>
                                                    <div class="fileUpload btn btn-primary">
                                                        <span>Upload</span>
                                                        <input id="imgItem-{{$item->id}}" name="img_item" type="file"
                                                               class="upload img-item-edit"/>
                                                    </div>
                                                </label>
                                                <label for="id_item">ID:
                                                    <input name="id_item" readonly type="text"
                                                           id="id-item-{{$item->id}}"
                                                           class="form-control form-expandido borda-arredondada"
                                                           value="{{$item->id}}">
                                                </label>
                                                <label for="nome">{{trans('site.name')}}:
                                                    <input name="nome" type="text"
                                                           class="form-control form-expandido borda-arredondada"
                                                           id="nome-{{$item->id}}"
                                                           value="{{$item->nome}}">
                                                </label>
                                                <label for="descricao">{{trans('site.desc')}}:
                                                    <textarea name="descricao"
                                                              class="form-control form-expandido area-text borda-arredondada"
                                                              id="descricao-{{$item->id}}"
                                                              rows="5">
{{$item->descricao}}
                                                    </textarea>
                                                </label>
                                                <div class="well well-lg well-status">
                                                    <label for="level">{{trans('site.lvl_full')}}:
                                                        <input name="level" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="level-{{$item->id}}"
                                                               value="{{$item->level}}">
                                                    </label>
                                                    <label for="for">{{trans('site.attr_str_full')}}:
                                                        <input name="for" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="for-{{$item->id}}"
                                                               value="{{$item->for}}">
                                                    </label>
                                                    <label for="int">{{trans('site.attr_int_full')}}:
                                                        <input name="int" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="int-{{$item->id}}"
                                                               value="{{$item->int}}">
                                                    </label>
                                                    <label for="agi">{{trans('site.attr_agi_full')}}:
                                                        <input name="agi" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="agi-{{$item->id}}"
                                                               value="{{$item->agi}}">
                                                    </label>
                                                    <label for="def">{{trans('site.attr_def_full')}}:
                                                        <input name="def" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="def-{{$item->id}}"
                                                               value="{{$item->def}}">
                                                    </label>
                                                    <label for="res">{{trans('site.attr_res_full')}}:
                                                        <input name="res" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="res-{{$item->id}}"
                                                               value="{{$item->res}}">
                                                    </label>
                                                    <label for="esp">{{trans('site.attr_swo_full')}}:
                                                        <input name="esp" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="esp-{{$item->id}}"
                                                               value="{{$item->esp}}">
                                                    </label>
                                                    <label for="evo">{{trans('site.attr_evo_full')}}:
                                                        <input name="evo" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="evo-{{$item->id}}"
                                                               value="{{$item->evo}}">
                                                    </label>
                                                    <label for="mag">{{trans('site.attr_mag_full')}}:
                                                        <input name="mag" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="mag-{{$item->id}}"
                                                               value="{{$item->mag}}">
                                                    </label>
                                                    <label for="energia">{{trans('site.energy')}}:
                                                        <input name="energia" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="energia-{{$item->id}}"
                                                               value="{{$item->energia}}">
                                                    </label>
                                                    <label for="vida">{{trans('site.attr_vit_full')}}:
                                                        <input name="vida" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="vida-{{$item->id}}"
                                                               value="{{$item->vida}}">
                                                    </label>
                                                    <label for="cols">{{trans('site.coin')}}:
                                                        <input name="cols" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="cols-{{$item->id}}"
                                                               value="{{$item->cols}}">
                                                    </label>
                                                    <label for="cash">{{trans('site.cash')}}:
                                                        <input name="cash" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="cash-{{$item->id}}"
                                                               value="{{$item->cash}}">
                                                    </label>
                                                    <label for="data-inicio">{{trans('site.date')}} {{trans('site.prime')}}
                                                        :
                                                        <input name="data_inicio" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="data-inicio-{{$item->id}}"
                                                               value="{{$item->data_inicio}}">
                                                    </label>
                                                    <label for="data-fim">{{trans('site.date')}} {{trans('site.end')}}:
                                                        <input name="data_fim" type="text"
                                                               class="form-control label-mini borda-arredondada"
                                                               id="data-fim-{{$item->id}}"
                                                               value="{{$item->data_fim}}">
                                                    </label>

                                                </div>
                                                <label for="id-avatar">{{trans('site.id')}} {{trans('site.avatar')}}:
                                                    <input name="id_avatar" type="text"
                                                           class="form-control label-mini borda-arredondada"
                                                           id="id-avatar-{{$item->id}}"
                                                           value="{{$item->id_avatar}}">
                                                </label>

                                                <label for="classe">{{trans('site.class')}}:
                                                    <select id="id-classe-{{$item->id}}" name="id_classe"
                                                            class="form-control">
                                                        <option value="99">Todas</option>
                                                        @foreach($classes as $classe)
                                                            @if ($item->id_classe == $classe->id)
                                                                <option selected
                                                                        value="{{$classe->id}}">{{$classe->classe}}</option>
                                                            @else
                                                                <option value="{{$classe->id}}">{{$classe->classe}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="id-grau-item">{{trans('site.grade')}}:
                                                    <select id="id-grau-item-{{$item->id}}" name="id_grau_item"
                                                            class="form-control">
                                                        {{-- <option value="99">Nenhum</option>--}}
                                                        @foreach($grauItem as $grau)
                                                            @if ($item->id_grau_item == $grau->id)
                                                                <option selected
                                                                        value="{{$grau->id}}">{{$grau->nome}}</option>
                                                            @else
                                                                <option value="{{$grau->id}}">{{$grau->nome}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="id-tipo-item">{{trans('site.type')}}:
                                                    <select id="id-tipo-item-{{$item->id}}" name="id_tipo_item"
                                                            class="form-control">
                                                        {{-- <option>Nenhum</option>--}}
                                                        @foreach($tipoItem as $tipo)
                                                            @if ($item->id_tipo_item == $tipo->id)
                                                                <option selected
                                                                        value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                            @else
                                                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="id-tipo-drop">{{trans('site.drop')}}:
                                                    <select id="id-tipo-drop-{{$item->id}}" name="id_tipo_drop"
                                                            class="form-control">
                                                        {{-- <option>Nenhum</option>--}}
                                                        @foreach($tipoDrop as $drop)
                                                            @if ($item->id_tipo_drop == $drop->id)
                                                                <option selected
                                                                        value="{{$drop->id}}">{{$drop->nome}}</option>
                                                            @else
                                                                <option value="{{$drop->id}}">{{$drop->nome}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                            <button id="idsubmit-{{$item->id}}" type="submit"
                                                    class="btn btn-primary btn-save-item">{!! trans('site.save') !!}</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                </form>
                            </div>


                            <tr class="text">
                                <td><img src="{{asset('img/itens/'.$item->grau.'/'.$item->id_avatar.'.png')}}"></td>
                                <td>{{$item->id}}</td>
                                <td>{{ $item->nome }}</td>
                                <td>{{ $item->descricao }}</td>
                                <td>{{ $item->level }}</td>
                                <td>{{ $item->classe ?: 'Todas' }}</td>
                                <td>{{ $item->cols }}</td>
                                <td>{{$item->grau}}</td>

                                {{--Ação--}}
                                <td>
                                    <button type="submit"
                                            class="btn btn-warning glyphicon glyphicon-pencil edit-adm-noticia"
                                            title="{{trans('site.edit')}} {{trans('site.news')}}"
                                            data-toggle="modal"
                                            data-target="#modal-adm-item-{{$item->id}}">
                                        <p>{{trans('site.edit')}}</p></button>
                                    <button id="iddel-{{$item->id}}" type="submit"
                                            class="btn btn-danger glyphicon glyphicon-remove excluir-adm-item"
                                            title="{{trans('site.delete')}} {{trans('site.news')}}">
                                        <p>{{trans('site.delete')}}</p></button>
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