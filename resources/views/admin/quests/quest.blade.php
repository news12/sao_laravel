@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('txt_lang.msg_panel_admin_quests') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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
    <div class=" modal fade" id="modal-criar-quest" data-backdrop="static">
        <form method="POST" action="{{url('/acQuest')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content borda-arredondada">
                    <div class="modal-header">
                        <p><b><h4> {!! trans('site.quest') !!}!</h4></b></p>
                    </div>
                    <div class="modal-body modal-adm-quests">
                        <div class="form-group">
                            <label for="img-quest">
                                <div class="uploadFile">IMG:
                                    <input id="uploadFile" placeholder="Selecione a imagem" disabled="disabled"/>
                                </div>
                                <div class="fileUpload btn btn-primary">
                                    <span>Upload</span>
                                    <input id="img-quest" name="img_quest" type="file" class="upload"/>
                                </div>
                            </label>
                            <label for="titulo">{{trans('site.name')}}:
                                <input name="titulo" type="text" placeholder="nome da Quest..."
                                       class="form-control form-expandido borda-arredondada"
                                       id="titulo"
                                       value="">
                            </label>
                            <label for="descricao">{{trans('site.desc')}}:
                                <textarea name="descricao" placeholder="descrição da quest..."
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
                                <label for="Guild">{{trans('site.clan')}}:
                                    <input name="guild" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="guild"
                                           value="0">
                                </label>
                                <label for="boss">{{trans('site.boss')}}:
                                    <input name="boss" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="boss"
                                           value="0">
                                </label>
                                <label for="status">{{trans('site.status')}}:
                                    <select id="status" name="status"
                                            class="form-control">
                                        <option value="0">Normal</option>
                                        <option value="1">Guild</option>
                                        <option value="2">Evento</option>
                                        <option value="3">Vip</option>

                                    </select>
                                </label>
                                <label for="cols">{{trans('site.coin')}}:
                                    <input name="cols" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="cols"
                                           value="0">
                                </label>
                                <label for="exp">{{trans('site.exp')}}:
                                    <input name="exp" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="exp"
                                           value="0">
                                </label>
                                <label for="itens">{{trans('site.item')}}:
                                    <input name="itens" type="text"
                                           class="form-control label-mini borda-arredondada"
                                           id="itens"
                                           value="0">
                                </label>

                                <label for="andar">{{trans('site.floor')}}:
                                    <select id="id-andar" name="id_andar"
                                            class="form-control">
                                        <option value="0">Nenhum</option>
                                        @foreach($andars as $andar)

                                            <option value="{{$andar->andar}}">{{$andar->andar}}º</option>

                                        @endforeach
                                    </select>
                                </label>

                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default pull-left btn-cancel-quest"
                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                            <button id="idsubmit-new-quest" type="submit"
                                    class="btn btn-primary btn-create-quest">{!! trans('site.create') !!}</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>

    <div class="d-flex flex-row justify-content-sm-center flex-wrap row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{strtoupper(trans('site.quest'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-criar-quest"
                            class="btn btn-success btn-new-quest">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-noticia-sao">
                    <table id="lista-quests"

                           class="table table-bordered table-responsive table-hover table-panel-noticias">

                        <thead>
                        <tr class="titulo">
                            <th>Img:</th>
                            <th>ID:</th>
                            <th>{{strtoupper(trans('site.name'))}}:</th>
                            <th>{{strtoupper(trans('site.desc'))}}:</th>
                            <th>{{strtoupper(trans('site.lvl_full'))}}:</th>
                            {{-- <th>{{strtoupper(trans('site.clan'))}}:</th>--}}
                            <th>{{strtoupper(trans('site.boss'))}}:</th>
                            <th>{{strtoupper(trans('site.status'))}}</th>
                            <th>{{strtoupper(trans('site.coin'))}}</th>
                            <th>{{strtoupper(trans('site.exp'))}}</th>
                            <th>{{strtoupper(trans('site.item'))}}</th>

                            {{--ação--}}
                            <th>{{strtoupper(trans('site.action'))}}:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($quests as $quest)
                            <div class=" modal fade" id="modal-adm-quest-{{$quest->id}}" data-backdrop="static">
                                <form method="POST" id="form-edit-quest" action="{{url('/aeQuest')}}"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content borda-arredondada">
                                            <div class="modal-header">
                                                <p><b><h4> {!! trans('site.item') !!}!</h4></b></p>
                                            </div>
                                            <div class="modal-body modal-adm-quests">
                                                <div class="form-group">
                                                    <label for="img-quest">
                                                        <div class="uploadFile">IMG:
                                                            <input id="uploadFile-{{$quest->id}}"
                                                                   placeholder="Selecione a imagem"
                                                                   disabled="disabled"/>
                                                        </div>
                                                        <div class="fileUpload btn btn-primary">
                                                            <span>Upload</span>
                                                            <input id="imgItem-{{$quest->id}}" name="img_quest"
                                                                   type="file"
                                                                   class="upload img-quest-edit"/>
                                                        </div>
                                                    </label>
                                                    <label for="id_quest">ID:
                                                        <input name="id_quest" readonly type="text"
                                                               id="id-quest-{{$quest->id}}"
                                                               class="form-control form-expandido borda-arredondada"
                                                               value="{{$quest->id}}">
                                                    </label>
                                                    <label for="titulo">{{trans('site.name')}}:
                                                        <input name="titulo" type="text"
                                                               class="form-control form-expandido borda-arredondada"
                                                               id="titulo-{{$quest->id}}"
                                                               value="{{$quest->titulo}}">
                                                    </label>
                                                    <label for="descricao">{{trans('site.desc')}}:
                                                        <textarea name="descricao"
                                                                  class="form-control form-expandido area-text borda-arredondada"
                                                                  id="descricao-{{$quest->id}}"
                                                                  rows="5">
{{$quest->descricao}}
                                                    </textarea>
                                                    </label>
                                                    <div class="well well-lg well-status">
                                                        <label for="level">{{trans('site.lvl_full')}}:
                                                            <input name="level" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="level-{{$quest->id}}"
                                                                   value="{{$quest->level}}">
                                                        </label>
                                                        <label for="guild">{{trans('site.clan')}}:
                                                            <input name="guild" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="guild-{{$quest->id}}"
                                                                   value="{{$quest->guild}}">
                                                        </label>
                                                        <label for="boss">{{trans('site.boss')}}:
                                                            <input name="boss" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="boss-{{$quest->id}}"
                                                                   value="{{$quest->boss}}">
                                                        </label>
                                                        <label for="status">{{trans('site.status')}}:
                                                            <input name="status" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="status-{{$quest->id}}"
                                                                   value="{{$quest->status}}">
                                                        </label>
                                                        <label for="cols">{{trans('site.coin')}}:
                                                            <input name="cols" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="cols-{{$quest->id}}"
                                                                   value="{{$quest->cols}}">
                                                        </label>
                                                        <label for="exp">{{trans('site.exp')}}:
                                                            <input name="exp" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="exp-{{$quest->id}}"
                                                                   value="{{$quest->exp}}">
                                                        </label>
                                                        <label for="itens">{{trans('site.item')}}:
                                                            <input name="itens" type="text"
                                                                   class="form-control label-mini borda-arredondada"
                                                                   id="itens-{{$quest->id}}"
                                                                   value="{{$quest->itens}}">
                                                        </label>
                                                        <label for="id-andar">{{trans('site.drop')}}:
                                                            <select id="id-andar-{{$quest->id}}" name="id_andar"
                                                                    class="form-control">
                                                                {{-- <option>Nenhum</option>--}}
                                                                @foreach($andars as $andar)
                                                                    @if ($andar->andar == $quest->andar)
                                                                        <option selected
                                                                                value="{{$andar->andar}}">{{$andar->andar}}
                                                                            º
                                                                        </option>
                                                                    @else
                                                                        <option value="{{$quest->andar}}">{{$quest->andar}}
                                                                            º
                                                                        </option>
                                                                    @endif

                                                                @endforeach
                                                            </select>
                                                        </label>


                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default pull-left btn-cancel-quest"
                                                        data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                <button id="idsubmit-{{$quest->id}}" type="submit"
                                                        class="btn btn-primary btn-save-quest">{!! trans('site.save') !!}</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form>
                            </div>


                            <tr class="text">
                                <td><img src="{{asset('img/quests/'.$quest->id.'.png')}}"></td>
                                <td>{{$quest->id}}</td>
                                <td>{{$quest->titulo }}</td>
                                <td>{{$quest->descricao }}</td>
                                <td>{{$quest->level }}</td>
                                {{-- <td>{{$quest->guild ?: 'Nenhuma' }}</td>--}}
                                <td>{{$quest->boss }}</td>
                                <td>{{$quest->status}}</td>
                                <td>{{$quest->cols}}</td>
                                <td>{{$quest->exp}}</td>
                                <td>{{$quest->itens}}</td>


                                {{--Ação--}}
                                <td>
                                    <button type="submit"
                                            class="btn btn-warning glyphicon glyphicon-pencil edit-adm-quest"
                                            title="{{trans('site.edit')}} {{trans('site.news')}}"
                                            data-toggle="modal"
                                            data-target="#modal-adm-quest-{{$quest->id}}">
                                        <p>{{trans('site.edit')}}</p></button>
                                    <form method="POST" action="{{url('/adQuest')}}">
                                        {{csrf_field()}}
                                        <input hidden name="delete_quest" id="delete-quest"
                                               value="{{$quest->id}}">
                                        <button id="iddel-{{$quest->id}}" type="submit"
                                                class="btn btn-danger glyphicon glyphicon-remove excluir-adm-quest"
                                                title="{{trans('site.delete')}} {{trans('site.news')}}">
                                            <p>{{trans('site.delete')}}</p></button>
                                    </form>
                                </td>

                            </tr>

                        @empty
                            <td> {!! trans('site.none_f') !!} {!! trans('site.quest') !!} {!! trans('site.found_f') !!}
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