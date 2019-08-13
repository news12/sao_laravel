@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.bag') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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

    {{--  <input id="id-bag-venda" hidden name="id_bag_venda">
      <button id="btn-venda2" hidden class="btn btn-primary"></button>--}}
    <div class=" modal fade" id="modalbag" data-backdrop="static">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content borda-arredondada">
                <div class="modal-header">
                    <p><b><h4> {!! trans('site.bag') !!}!</h4></b></p>
                    <input id="id-bag" hidden name="id_bag">
                </div>
                <div class="modal-body">
                    <p>{!! trans('txt_lang.msg_acao_item_bag') !!}<b>

                            <h2>
                                <img id="img-bag-modal" class="relative" src="">
                                <div class="item-raro relative-txt" id="item-bag-select">
                                </div>
                            </h2>
                        </b>
                    </p>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                    <button id="btn-venda" type="button" class="btn btn-warning pull-left">
                        {!! trans('site.sell') !!}</button>
                    <button id="id-submit-bag" class="btn btn-primary">{!! trans('site.put') !!}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class=" modal fade" id="modalslot" data-backdrop="static">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content borda-arredondada">
                <div class="modal-header">
                    <p><b><h4> {!! trans('site.character') !!}!</h4></b></p>
                    <input id="id-slot" hidden name="id_slot">
                </div>
                <div class="modal-body">
                    <p>{!! trans('txt_lang.msg_acao_item_slot') !!}<b>
                            <h2>
                                <img id="img-slot-modal" class="relative" src="">
                                <div class="item-raro relative-txt" id="item-slot-select"></div>
                            </h2>
                        </b></p>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                    <button id="id-submit-slot" class="btn btn-primary">{!! trans('site.remove') !!}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

    </div>

    <div class="d-flex flex-row justify-content-sm-center flex-wrap content-mochila">
        <div class="slot-perso">
            <p>{!! trans('site.character') !!}</p>
            @foreach($itens_bag as $itens_equipado)
                @if ($arma_equipado == true && $itens_equipado->status ==1)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click  arma1 backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>
                            </table>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>
                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($arma_equipado == false)

                    <div id="arma1" class="img-responsive popover-avatar arma1" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.weapon') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_wapon') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($escudo_equipado == true && $itens_equipado->status ==2)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click  arma2 backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($escudo_equipado == false)

                    <div class="img-responsive popover-avatar arma2" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.shield') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_shield') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($colar_equipado == true && $itens_equipado->status ==9)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click colar backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($colar_equipado == false)

                    <div class="img-responsive popover-avatar colar" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.necklace') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_necklace') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($manto_equipado == true && $itens_equipado->status ==8)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click manto backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($manto_equipado == false)

                    <div class="img-responsive popover-avatar manto" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.mantle') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_mantle') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($brinco_D_equipado == true && $itens_equipado->status ==10)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click brinco-d backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($brinco_D_equipado == false)

                    <div class="img-responsive popover-avatar brinco-d" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.earring') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_earring') !!} D"
                         data-trigger="click">

                    </div>

                @endif

                @if ($brinco_E_equipado == true && $itens_equipado->status ==11)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click brinco-e backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                    <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($brinco_E_equipado == false)

                    <div class="img-responsive popover-avatar brinco-e" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.earring') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_earring') !!} E"
                         data-trigger="click">

                    </div>

                @endif


                @if ($anel_D_equipado == true && $itens_equipado->status ==12)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click anel-d backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($anel_D_equipado == false)

                    <div class="img-responsive popover-avatar anel-d" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.ring') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_ring') !!} D"
                         data-trigger="click">

                    </div>

                @endif

                @if ($anel_E_equipado == true && $itens_equipado->status ==13)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click anel-e backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($anel_E_equipado == false)

                    <div class="img-responsive popover-avatar anel-e" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.ring') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_ring') !!} E"
                         data-trigger="click">

                    </div>

                @endif

                @if ($elmo_equipado == true && $itens_equipado->status ==3)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click elmo backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($elmo_equipado == false)

                    <div class="img-responsive popover-avatar elmo" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.helmet') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_helmet') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($armadura_equipado == true && $itens_equipado->status ==4)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click armadura backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($armadura_equipado == false)

                    <div class="img-responsive popover-avatar armadura" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.armor') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_armor') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($luva_equipado == true && $itens_equipado->status ==6)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click luva backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($luva_equipado == false)

                    <div class="img-responsive popover-avatar luva" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.glove') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_glover') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($pet_equipado == true && $itens_equipado->status ==14)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click pet backgroud-none" data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($pet_equipado == false)

                    <div class="img-responsive popover-avatar pet" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.pet') !!}" data-content="{!! trans('txt_lang.msg_slot_pet') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($calca_equipado == true && $itens_equipado->status ==5)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click calca backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($calca_equipado == false)

                    <div id="calca" class="popover-avatar calca" data-html="true"
                         data-placement="auto-left"
                         data-title="{!! trans('site.pants') !!}"
                         data-content="{!! trans('txt_lang.msg_slot_pants') !!}"
                         data-trigger="click">

                    </div>

                @endif

                @if ($bota_equipado == true && $itens_equipado->status ==7)
                    <img id="{{$itens_equipado->status}}-{!! $itens_equipado->nome !!}"
                         class="popover-itens-bag slot-click bota backgroud-none"
                         data-html="true"
                         data-placement="auto-bottom"
                         data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens_equipado->grau}}'>{!! $itens_equipado->nome !!}</div></th>
                                <th scope='col'>Classe:<br> <div class='item-comum'>{{$itens_equipado->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens_equipado->grau}}'scope='col'>Grau:<br> <div class='item-{{$itens_equipado->grau}}'>{{$itens_equipado->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens_equipado->tipo}}</div></th>
                            </tr>
                            </thead>"
                         data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens_equipado->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                 <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens_equipado->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens_equipado->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens_equipado->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens_equipado->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens_equipado->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens_equipado->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens_equipado->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens_equipado->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens_equipado->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens_equipado->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens_equipado->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens_equipado->cols,2,'.',',')}}</div>
                                         </div>

                                         <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens_equipado->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens_equipado->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens_equipado->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens_equipado->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens_equipado->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens_equipado->bloqueio,2,',','.')}}%</p></div>
                                            </div>

                                </div>
"
                         data-trigger="click"
                         src="{{asset('img/itens/'.$itens_equipado->grau.'/'.$itens_equipado->id_avatar.'.png')}}">

                @elseif ($bota_equipado == false)

                    <div class="popover-avatar bota" data-html="true"
                         data-placement="auto-right"
                         data-title="{!! trans('site.boot') !!}" data-content="{!! trans('txt_lang.msg_slot_boot') !!}"
                         data-trigger="click">


                    </div>

                @endif


            @endforeach
        </div>
        <div class="bag">
            <p>{!! trans('site.bag') !!}</p>
            <div id="slots-bag" class="d-flex flex-row justify-content-sm-center flex-wrap slots">
                @for ($bag = $total_itens; $bag < $total_slot +1 ; $bag++)
                    @if ($bag <= $total_itens )
                        @foreach($itens_bag as $itens)
                            @if ($itens->status == 0)
                                <img id="{{$itens->id_mochila}}-{{$itens->nome}}"
                                     class="popover-itens-bag slot-vazio item bag-click" draggable="true"
                                     ondragstart="drag(event)" data-html="true"
                                     data-placement="auto-bottom"
                                     data-title="<table class=' table-popover'>
                            <thead>
                            <tr>
                                <th scope='col'>Nome:<br> <div class='item-{{$itens->grau}}'>{!! $itens->nome !!}</div></th>
                                <th 'scope='col'>Classe:<br> <div class='item-comum'>{{$itens->classe ?:'Todas'}}</div></th>
                                <th class='item-{{$itens->grau}} scope='col'>Grau:<br> <div class='item-{{$itens->grau}}'>{{$itens->grau}}</div></th>
                                <th style='border:none' scope='col'>Tipo:<br> <div class='item-comum'>{{$itens->tipo}}</div></th>
                            </tr>
                            </thead>"
                                     data-content="<h6><b>{!! trans('site.desc') !!}:</b></h6> <div class='item-comum'>{!! $itens->descricao !!}</div><br>
                                    <div class='status-bag'>
                                    <h6><b>{!! trans('site.status') !!}:</b></h6>
                                        <div class='desc-status level-color'>
                                        Req.Lv.: <div class='level-color'>{{$itens->level}}</div>
                                         </div>
                                         <div class='desc-status for'>
                                        For.: <div class='for'>{{$itens->for}}</div>
                                         </div>
                                         <div class='desc-status agi'>
                                        Agi.: <div class='agi'>{{$itens->agi}}</div>
                                         </div>
                                         <div class='desc-status int'>
                                        Int.: <div class='int'>{{$itens->int}}</div>
                                         </div>
                                         <div class='desc-status esp'>
                                        Esp.: <div class='esp'>{{$itens->esp}}</div>
                                         </div>
                                         <div class='desc-status mag'>
                                        Mag.: <div class='mag'>{{$itens->mag}}</div>
                                         </div>
                                         <div class='desc-status evo'>
                                        Evo.: <div class='evo'>{{$itens->evo}}</div>
                                         </div>
                                         <div class='desc-status def'>
                                        Def.: <div class='def'>{{$itens->def}}</div>
                                         </div>
                                         <div class='desc-status res'>
                                        Res.: <div class='res'>{{$itens->res}}</div>
                                         </div>
                                          <div class='desc-status hp'>
                                        HP.: <div class='hp'>{{$itens->vida}}</div>
                                         </div>
                                          <div class='desc-status energia'>
                                        Energia.: <div class='energia'>{{$itens->energia}}</div>
                                         </div>
                                          <div class='desc-status cols'>
                                        Preço.: <div class='cols'>{{number_format($itens->cols,2,'.',',')}}</div>
                                         </div>
                                         @if (($itens->id_tipo_item !=0) && ($itens->id_tipo_item !=15))
                                             <div class='status-power'>
                                                <div class='poder sem-borda'>Poder M.: <p>{{number_format($itens->poder_magico,2,',','.')}}</p></div>
                                                 <div class='poder'>Poder F.: <p>{{number_format($itens->poder_fisico,2,',','.')}}</p></div>
                                                  <div class='poder'>Poder E.: <p>{{number_format($itens->poder_evocacao,2,',','.')}}</p></div>
                                                   <div class='poder'>Esquiva: <p>{{number_format($itens->esquiva,2,',','.')}}%</p></div>
                                                    <div class='poder'>Critico: <p>{{number_format($itens->critico,2,',','.')}}%</p></div>
                                                    <div class='poder'>Bloqueio: <p>{{number_format($itens->bloqueio,2,',','.')}}%</p></div>
                                            </div>
                                        @endif

                                             </div>
                                             </table>
"
                                     data-trigger="click"
                                     src="{{asset('img/itens/'.$itens->grau.'/'.$itens->id_avatar.'.png')}}">


                            @endif
                        @endforeach

                    @elseif($bag > $total_itens)
                        <div id="{{$bag}}" class="slot-vazio">

                        </div>

                    @endif
                @endfor

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