@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('txt_lang.msg_panel_admin_news') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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
    <div class=" modal fade" id="modal-adm-noticia-criar" data-backdrop="static">
        {{--  <form method="POST" action="{{url('/acNoticia')}}">
              {{csrf_field()}}--}}
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content borda-arredondada">
                <div class="modal-header">
                    <p><b><h4> {!! trans('site.news') !!}!</h4></b></p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Titulo:
                            <input name="titulo" type="text"
                                   class="form-control form-expandido borda-arredondada"
                                   id="titulo-criar"
                                   value="">
                        </label>
                        <label for="noticia">Noticia:
                            <textarea name="noticia" class="form-control form-expandido area-text borda-arredondada"
                                      id="noticia-criar"
                                      rows="5">

                            </textarea>
                        </label>
                        <label for="categoria">Categoria:
                            <input name="categoria" type="text" class="form-control form-expandido borda-arredondada"
                                   id="categoria-criar"
                                   value="">
                            <b> noticia,update,novidade</b>
                        </label>

                        <label for="data">Data:
                            <input name="data" type="datetime-local"
                                   class="form-control form-expandido datetimepicker borda-arredondada"
                                   id="data-criar"
                                   value="">
                        </label>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default pull-left btn-cancel-noticia"
                            data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                    <button id="submit-noticia" type="submit"
                            class="btn btn-primary btn-create-noticia">{!! trans('site.create') !!}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        {{--  </form>--}}
    </div>

    <div class="d-flex flex-row justify-content-sm-center flex-wrap row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{strtoupper(trans('site.news_p'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-adm-noticia-criar"
                            class="btn btn-success btn-new-noticia">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-noticia-sao">
                    <table id="lista-noticias"

                           class="table table-bordered table-responsive table-hover table-panel-noticias">

                        <thead>
                        <tr class="titulo">
                            <th>ID:</th>
                            <th>{{strtoupper(trans('site.title'))}}:</th>
                            <th>{{strtoupper(trans('site.news'))}}:</th>
                            <th>{{strtoupper(trans('site.category'))}}:</th>
                            <th>{{strtoupper(trans('site.date'))}}:</th>
                            <th>{{strtoupper(trans('site.action'))}}:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($p_noticias as $noticia)
                            <div class=" modal fade" id="modal-adm-noticia-{{$noticia->id}}" data-backdrop="static">
                                {{-- <form method="POST" action="{{url('/aeNoticia')}}">
                                     {{csrf_field()}}--}}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content borda-arredondada">
                                        <div class="modal-header">
                                            <p><b><h4> {!! trans('site.news') !!}!</h4></b></p>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id_noticia">ID:
                                                    <input name="id_noticia" readonly type="text"
                                                           id="id-noticia-{{$noticia->id}}"
                                                           class="form-control form-expandido borda-arredondada"
                                                           value="{{$noticia->id}}">
                                                </label>
                                                <label for="titulo">Titulo:
                                                    <input name="titulo" type="text"
                                                           class="form-control form-expandido borda-arredondada"
                                                           id="titulo-{{$noticia->id}}"
                                                           value="{{$noticia->titulo}}">
                                                </label>
                                                <label for="noticia">Noticia:
                                                    <textarea name="noticia"
                                                              class="form-control form-expandido area-text borda-arredondada"
                                                              id="noticia-{{$noticia->id}}"
                                                              rows="5">
{{$noticia->noticia}}
                                                    </textarea>
                                                </label>
                                                <label for="categoria">Categoria:
                                                    <input name="categoria" type="text"
                                                           class="form-control form-expandido borda-arredondada"
                                                           id="categoria-{{$noticia->id}}"
                                                           value="{{$noticia->categoria}}">
                                                    <b> noticia,update,novidade</b>
                                                </label>

                                                <label for="data">Data:
                                                    <input name="data" type="datetime-local"
                                                           class="form-control form-expandido datetimepicker borda-arredondada"
                                                           id="data-{{$noticia->id}}"
                                                           value="{{$noticia->data}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default pull-left btn-cancel-noticia"
                                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                            <button id="idsubmit-{{$noticia->id}}" type="submit"
                                                    class="btn btn-primary btn-save-noticia">{!! trans('site.save') !!}</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                {{-- </form>--}}
                            </div>


                            <tr class="text">
                                <td>{{$noticia->id}}</td>
                                <td>{{ $noticia->titulo }}</td>
                                <td>{{ $noticia->noticia }}</td>
                                <td>{{ $noticia->categoria }}</td>
                                <td>{{ $noticia->data }}</td>
                                <td>
                                    {{-- <form method="POST" action="{{url('/adNoticia')}}">
                                         {{csrf_field()}}
                                         <div hidden>
                                             <input id="id-noticia"name="id_noticia" value="{{$noticia->id}}">
                                         </div>--}}
                                    <button type="submit"
                                            class="btn btn-warning glyphicon glyphicon-pencil edit-adm-noticia"
                                            title="{{trans('site.edit')}} {{trans('site.news')}}"
                                            data-toggle="modal"
                                            data-target="#modal-adm-noticia-{{$noticia->id}}">
                                        <p>{{trans('site.edit')}}</p></button>
                                    <button id="iddel-{{$noticia->id}}" type="submit"
                                            class="btn btn-danger glyphicon glyphicon-remove excluir-adm-noticia"
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