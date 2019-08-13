@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.status') !!} {!! trans('site.character') !!} » {!! trans('site.welcome') !!}!!! »
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
    <div class="d-flex flex-row justify-content-sm-center flex-wrap status-personagem">
        @foreach($status_personagem as $status)
            @foreach($max_atributos as $atributo)

                <div class=" status1">
                    <p class="status-personagem-titulo">{{$status->nome}}</p>
                    <div class="p-2 flex-fill info-basic-t2"><b>{!! trans('site.info_basic') !!}</b></div>
                    <div class="d-flex flex-row justify-content-sm-center flex-wrap status-info-basic">
                        <div class=" info"><b>{!! trans('site.character') !!}: </b>{{$status->avatar}}</div>
                        <div class=" info"><b>{!! trans('site.class') !!}: </b>{{$status->classe}}</div>
                        <div class=" info"><b>{!! trans('site.clan') !!}: </b>{{$status->guild}}</div>
                        <div class=" info"><b>{!! trans('site.rank') !!}: </b>{{$ranking}}º</div>
                        <div class=" info"><b>{!! trans('site.floor') !!}: </b>{{$status->andar}}º</div>
                        <div class=" info"><b>{!! trans('site.city') !!}/{!! trans('site.map') !!}
                                : </b>{{$status->cidade}}</div>
                        <div class=" info"><b>{!! trans('site.victory') !!} {!! trans('site.pvm') !!}
                                : </b>{{$status->vitoria_pvm}}</div>
                        <div class=" info"><b>{!! trans('site.victory') !!} {!! trans('site.pvp') !!}
                                : </b>{{$status->vitoria_pvp}}</div>
                        <div class=" info"><b>{!! trans('site.defeat') !!} {!! trans('site.pvm') !!}
                                : </b>{{$status->derrota_pvm}}</div>
                        <div class=" info"><b>{!! trans('site.defeat') !!} {!! trans('site.pvp') !!}
                                : </b>{{$status->derrota_pvp}}</div>
                        <div class=" info"><b>{!! trans('site.escape') !!} {!! trans('site.pvm') !!}
                                : </b>{{$status->fuga_pvm}}</div>
                        <div class=" info"><b>{!! trans('site.escape') !!} {!! trans('site.pvp') !!}
                                : </b>{{$status->fuga_pvp}}</div>
                        <div class=" info"><b>{!! trans('site.draw') !!}: </b>{{$status->empate}}</div>
                        <div class=" info"><b>{!! trans('site.team') !!}: </b>{{$equipe_jogador}}</div>
                        <div class=" info"><b>{!! trans('site.lvl_full') !!}: </b>{{$status->level}}</div>
                        <div class=" info"><b>{!! trans('site.coin') !!}: </b>{{number_format($status->cols,2,',','.')}}
                        </div>


                    </div>
                </div>
                <div class="p-2 flex-fill status2">
                    <form method="POST" action="{{url('/updateStatusP')}}">
                        {{ csrf_field() }}
                        <div hidden>
                            <label>
                                <input id="for_input" name="for_input">
                                <input id="int_input" name="int_input">
                                <input id="agi_input" name="agi_input">
                                <input id="def_input" name="def_input">
                                <input id="res_input" name="res_input">
                                <input id="vit_input" name="vit_input">
                                <input id="esp_input" name="esp_input">
                                <input id="mag_input" name="mag_input">
                                <input id="evo_input" name="evo_input">
                                <input id="pontos_input" name="pontos_input">
                            </label>
                        </div>
                        <p class="status-personagem-titulo">{!! trans('site.attributes') !!}</p>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_str_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_str') !!}"
                                   data-trigger="click">{!! trans('site.attr_str') !!}:</b>
                            <p class="status-bar-text">{{$status->forca}}/{{$atributo->max_for}}</p>
                            <div id="for_news" class="status-add-news"><b>0</b></div>
                            <div id="add_for" class="add-pontos">
                                <button type="button" id="btnMinus_for" class="minus-status"></button>
                                <button type="button" id="btnPlus_for" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('str_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_int_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_int') !!}"
                                   data-trigger="click">{!! trans('site.attr_int') !!}:</b>
                            <p class="status-bar-text">{{$status->inteligencia}}/{{$atributo->max_int}}</p>
                            <div id="int_news" class="status-add-news"><b>0</b></div>
                            <div id="add_int" class="add-pontos">
                                <button type="button" id="btnMinus_int" class="minus-status"></button>
                                <button type="button" id="btnPlus_int" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('int_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_agi_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_agi') !!}"
                                   data-trigger="click">{!! trans('site.attr_agi') !!}:</b>
                            <p class="status-bar-text">{{$status->agilidade}}/{{$atributo->max_agi}}</p>
                            <div id="agi_news" class="status-add-news"><b>0</b></div>
                            <div id="add_agi" class="add-pontos">
                                <button type="button" id="btnMinus_agi" class="minus-status"></button>
                                <button type="button" id="btnPlus_agi" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('agi_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_def_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_def') !!}"
                                   data-trigger="click">{!! trans('site.attr_def') !!}:</b>
                            <p class="status-bar-text">{{$status->defesa}}/{{$atributo->max_def}}</p>
                            <div id="def_news" class="status-add-news"><b>0</b></div>
                            <div id="add_def" class="add-pontos">
                                <button type="button" id="btnMinus_def" class="minus-status"></button>
                                <button type="button" id="btnPlus_def" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('def_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_res_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_res') !!}"
                                   data-trigger="click">{!! trans('site.attr_res') !!}:</b>
                            <p class="status-bar-text">{{$status->resistencia}}/{{$atributo->max_res}}</p>
                            <div id="res_news" class="status-add-news"><b>0</b></div>
                            <div id="add_res" class="add-pontos">
                                <button type="button" id="btnMinus_res" class="minus-status"></button>
                                <button type="button" id="btnPlus_res" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('res_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_vit_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_vit') !!}"
                                   data-trigger="click">{!! trans('site.attr_vit') !!}:</b>
                            <p class="status-bar-text">{{$status->vitalidade}}/{{$atributo->max_vit}}</p>
                            <div id="vit_news" class="status-add-news"><b>0</b></div>
                            <div id="add_vit" class="add-pontos">
                                <button type="button" id="btnMinus_vit" class="minus-status"></button>
                                <button type="button" id="btnPlus_vit" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('vit_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_swo_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_swo') !!}"
                                   data-trigger="click">{!! trans('site.attr_swo') !!}:</b>
                            <p class="status-bar-text">{{$status->espada}}/{{$atributo->max_esp}}</p>
                            <div id="esp_news" class="status-add-news"><b>0</b></div>
                            <div id="add_esp" class="add-pontos">
                                <button type="button" id="btnMinus_esp" class="minus-status"></button>
                                <button type="button" id="btnPlus_esp" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('esp_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_mag_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_mag') !!}"
                                   data-trigger="click">{!! trans('site.attr_mag') !!}:</b>
                            <p class="status-bar-text">{{$status->magia}}/{{$atributo->max_mag}}</p>
                            <div id="mag_news" class="status-add-news"><b>0</b></div>
                            <div id="add_mag" class="add-pontos">
                                <button type="button" id="btnMinus_mag" class="minus-status"></button>
                                <button type="button" id="btnPlus_mag" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('mag_width')}}px"></div>

                        </div>
                        <div class="atributos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.attr_evo_full') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_evoc') !!}"
                                   data-trigger="click">{!! trans('site.attr_evo') !!}:</b>
                            <p class="status-bar-text">{{$status->evoc}}/{{$atributo->max_evo}}</p>
                            <div id="evo_news" class="status-add-news"><b>0</b></div>
                            <div id="add_evo" class="add-pontos">
                                <button type="button" id="btnMinus_evo" class="minus-status"></button>
                                <button type="button" id="btnPlus_evo" class="plus-status"></button>
                            </div>
                            </p>
                            <div class="status-bar" style="width: {{$formula->get('evo_width')}}px"></div>

                        </div>
                        <div class="pontos">
                            <p>
                                <b class="popover-itens-bag" data-html="true"
                                   data-placement="auto-left"
                                   data-title="{!! trans('site.points') !!}"
                                   data-content="{!! trans('txt_lang.msg_status_pontos') !!}"
                                   data-trigger="click">{!! trans('site.points') !!}:</b>
                            <p id="status_pontos" class="text">{{$status->ponto}}</p>
                            </p>

                        </div>
                        <button id="btn_aplicar" type="submit"
                                class="btn btn-secondary btn-aplicar">{!! trans('site.apply') !!}</button>
                        <p class="status-personagem-titulo2"><b>{!! trans('site.info_combat') !!}</b></p>
                        <div class="info-status info-borda-top">
                            <p class="item-lendario"><b>{!! trans('site.power') !!}
                                    : </b>{{number_format($formula->get('power_personagem'),2,',','.')}}
                                +({{number_format($formula->get('power_item'),2,',','.')}})
                                » {{number_format($power,2,',','.')}}
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-superior"><b>{!! trans('site.dmg_p') !!}
                                    : </b>{{number_format($formula->get('dano_fisico'),2,',','.')}}
                                +({{number_format($formula->get('item_dano_fisico'),2,',','.')}})
                                » {{number_format($formula->get('item_dano_fisico')+$formula->get('dano_fisico'),2,',','.')}}
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-superior"><b>{!! trans('site.dmg_m') !!}
                                    : </b>{{number_format($formula->get('dano_magico'),2,',','.')}}
                                +({{number_format($formula->get('item_dano_magico'),2,',','.')}})
                                » {{number_format($formula->get('dano_magico')+$formula->get('item_dano_magico'),2,',','.')}}
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-superior"><b>{!! trans('site.dmg_evoc') !!}
                                    : </b>{{number_format($formula->get('dano_evoc'),2,',','.')}}
                                +({{number_format($formula->get('item_dano_evoc'),2,',','.')}})
                                » {{number_format($formula->get('dano_evoc')+$formula->get('item_dano_evoc'),2,',','.')}}
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-superior"><b>{!! trans('site.def_p') !!}
                                    : </b>{{number_format($formula->get('defesa'),2,',','.')}}
                                +({{number_format($formula->get('item_defesa'),2,',','.')}})
                                » {{number_format($formula->get('defesa')+$formula->get('item_defesa'),2,',','.')}}</p>
                        </div>
                        <div class="info-status">
                            <p class="item-superior"><b>{!! trans('site.def_m') !!}
                                    : </b>{{number_format($formula->get('resistencia'),2,',','.')}}
                                +({{number_format($formula->get('item_resistencia'),2,',','.')}})
                                » {{number_format($formula->get('resistencia')+$formula->get('item_resistencia'),2,',','.')}}
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-raro"><b>{!! trans('site.attr_evad') !!}
                                    : </b>{{number_format($formula->get('esquiva'),1,'.',',')}}%
                                +({{number_format($formula->get('item_esquiva'),1,'.',',')}}%)
                                » {{number_format($formula->get('esquiva')+$formula->get('item_esquiva'),1,'.',',')}}%
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-supremo"><b>{!! trans('site.attr_crit') !!}
                                    : </b>{{number_format($formula->get('critico'),1,'.',',')}}%
                                +({{number_format($formula->get('item_critico'),1,'.',',')}}%)
                                » {{number_format($formula->get('critico')+$formula->get('item_critico'),1,'.',',')}}%
                            </p>
                        </div>
                        <div class="info-status">
                            <p class="item-raro"><b>{!! trans('site.attr_block') !!}
                                    : </b>{{number_format($formula->get('bloqueio'),1,'.',',')}}%
                                +({{number_format($formula->get('item_bloqueio'),1,'.',',')}}%)
                                » {{number_format($formula->get('bloqueio')+$formula->get('item_bloqueio'),1,'.',',')}}%
                            </p>
                    </form>
                </div>

            @endforeach
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