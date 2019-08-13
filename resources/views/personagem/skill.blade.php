@extends('adminlte::page')


@section('title', 'Sword Art Online(NG)')
@section('content_header')
    <p>{!! trans('site.skill2') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p>
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

    <div class="d-flex flex-row justify-content-sm-center flex-wrap content-skill">
        <div class="skill-list">

            <div class="container">
                <div class="bd-example bd-example-tabs">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                               role="tab" aria-controls="pills-home" aria-selected="true">Skill Aprendida</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-classe-tab" data-toggle="pill" href="#pills-classe"
                               role="tab" aria-controls="pills-classe" aria-selected="false">Skill Classe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-skill-clan-tab" data-toggle="pill" href="#pills-skill-clan"
                               role="tab" aria-controls="pills-skill-clan" aria-selected="false">Skill Clan</a>
                        </li>
                    </ul>
                    <div class="tab-content d-flex flex-row justify-content-sm-center flex-wrap" id="pills-tabContent">
                        <div class="tab-pane fade active show " id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            @forelse($skills as $skill)

                                <div class="skill-status">
                                    <img class="s-avatar-skill popover-itens-bag"
                                         data-html="true"
                                         data-placement="auto-right"
                                         data-title="Status da Skill:  <b class='color-orange'>{{$skill->nome}}</b>"
                                         data-content="<table class=' status-power'>
                            <thead>
                            <tr>
                                <th class='poder' scope='col'>Req.Level:<br> <div class='item-comum'>{!! $skill->reqlevel !!}</div></th>
                                <th class='poder' scope='col'>Req.Missao:<br> <div class='item-comum'>{{$skill->reqmissao}}</div></th>
                                <th class='poder' scope='col'>Req.Evento:<br> <div class='item-comum'>{{$skill->reqevento}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Dano.Fisico:<br> <div class='item-comum'>{{$skill->dano_fisico}}</div></th>
                                <th class='poder' scope='col'>Dano.Magico:<br> <div class='item-comum'>{{$skill->dano_magico}}</div></th>
                                <th class='poder' scope='col'>Dano.Evoc:<br> <div class='item-comum'>{{$skill->dano_evoc}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Critico:<br> <div class='item-comum'>{{$skill->critico}}</div></th>
                                <th class='poder' scope='col'>Esquiva:<br> <div class='item-comum'>{{$skill->esquiva}}</div></th>
                                <th class='poder' scope='col'>Bloqueio:<br> <div class='item-comum'>{{$skill->bloqueio}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Defesa:<br> <div class='item-comum'>{{$skill->defesa}}</div></th>
                                <th class='poder' scope='col'>Resistencia:<br> <div class='item-comum'>{{$skill->resistencia}}</div></th>
                                <th class='poder' scope='col'>HP:<br> <div class='item-comum'>{{$skill->hp}}</div></th>

                            </tr>

                             <tr>
                                <th class='poder' scope='col'>Cura:<br> <div class='item-comum'>{{$skill->cura}}</div></th>
                                <th class='poder' scope='col'>Expira:<br> <div class='item-comum'>{{$skill->expira}}</div></th>
                                 <th class='poder' scope='col'>Data Fim:<br> <div class='item-comum'>{{$skill->fim}}</div></th>

                            </tr>
                            </thead>
                            </table>"

                                         data-trigger="click"
                                         src="{{asset('img/skill/'.$skill->id_classe.'/'.$skill->avatar.'.png')}}">
                                    <p class="s-nome">{{$skill->nome}}</p>
                                    <p class="s-level">Lv: {{$skill->level}}/100</p>
                                    <p class="s-energia">C.Energia: {{$skill->energia}}</p>
                                    <p class="s-desc">{{$skill->descricao}}</p>

                                </div>


                            @empty
                                <td class="t-status t-active"
                                    style="text-align: center"> {!! trans('site.none_f') !!} {!! trans('site.skill') !!} {!! trans('site.available') !!}
                                    ...
                                </td>


                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-classe" role="tabpanel"
                             aria-labelledby="pills-classe-tab">
                            @forelse($new_skill as $skill)

                               {{-- @if ($skill->id !==$id_skill_aprendida)--}}
                                    <div class="skill-status">
                                        {{--<form method="POST" action="{{url('/cSkill')}}">
                                             {{csrf_field()}}--}}
                                        <div hidden>
                                            <input hidden value="{{$skill->id}}" name="id_skill">
                                        </div>
                                        <img class="s-avatar-skill popover-itens-bag"
                                             data-html="true"
                                             data-placement="auto-right"
                                             data-title="Status da Skill:  <b class='color-orange'>{{$skill->nome}}</b>"
                                             data-content="<table class=' status-power'>
                            <thead>
                            <tr>
                                <th class='poder' scope='col'>Req.Level:<br> <div class='item-comum'>{!! $skill->reqlevel !!}</div></th>
                                <th class='poder' scope='col'>Req.Missao:<br> <div class='item-comum'>{{$skill->reqmissao}}</div></th>
                                <th class='poder' scope='col'>Req.Evento:<br> <div class='item-comum'>{{$skill->reqevento}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Dano.Fisico:<br> <div class='item-comum'>{{$skill->dano_fisico}}</div></th>
                                <th class='poder' scope='col'>Dano.Magico:<br> <div class='item-comum'>{{$skill->dano_magico}}</div></th>
                                <th class='poder' scope='col'>Dano.Evoc:<br> <div class='item-comum'>{{$skill->dano_evoc}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Critico:<br> <div class='item-comum'>{{$skill->critico}}</div></th>
                                <th class='poder' scope='col'>Esquiva:<br> <div class='item-comum'>{{$skill->esquiva}}</div></th>
                                <th class='poder' scope='col'>Bloqueio:<br> <div class='item-comum'>{{$skill->bloqueio}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Defesa:<br> <div class='item-comum'>{{$skill->defesa}}</div></th>
                                <th class='poder' scope='col'>Resistencia:<br> <div class='item-comum'>{{$skill->resistencia}}</div></th>
                                <th class='poder' scope='col'>HP:<br> <div class='item-comum'>{{$skill->hp}}</div></th>

                            </tr>

                             <tr>
                                <th class='poder' scope='col'>Cura:<br> <div class='item-comum'>{{$skill->cura}}</div></th>
                                <th class='poder' scope='col'>Expira:<br> <div class='item-comum'>{{$skill->expira}}</div></th>
                                 <th class='poder' scope='col'>Data Fim:<br> <div class='item-comum'>{{$skill->fim}}</div></th>

                            </tr>
                            </thead>
                            </table>"

                                             data-trigger="click"
                                             src="{{asset('img/skill/'.$skill->id_classe.'/'.$skill->avatar.'.png')}}">
                                        <p class="s-nome">{{$skill->nome}}</p>
                                        <p class="s-level">Lv: {{$skill->level}}</p>
                                        <p class="s-energia">Cols: {{$skill->cols}}</p>
                                        <p class="s-desc">{{$skill->descricao}}</p>
                                        <button id="{{$skill->id}}" type="submit" class="btn btn_skill_buy">Aprender
                                        </button>
                                        {{-- </form>--}}
                                    </div>
                             {{--   @else
                                    <div class="skill-status print-cinza">
                                        <img class="s-avatar-skill popover-itens-bag"
                                             data-html="true"
                                             data-placement="auto-right"
                                             data-title="Status da Skill:  <b class='color-orange'>{{$skill->nome}}</b>"
                                             data-content="<table class=' status-power'>
                            <thead>
                            <tr>
                                <th class='poder' scope='col'>Req.Level:<br> <div class='item-comum'>{!! $skill->reqlevel !!}</div></th>
                                <th class='poder' scope='col'>Req.Missao:<br> <div class='item-comum'>{{$skill->reqmissao}}</div></th>
                                <th class='poder' scope='col'>Req.Evento:<br> <div class='item-comum'>{{$skill->reqevento}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Dano.Fisico:<br> <div class='item-comum'>{{$skill->dano_fisico}}</div></th>
                                <th class='poder' scope='col'>Dano.Magico:<br> <div class='item-comum'>{{$skill->dano_magico}}</div></th>
                                <th class='poder' scope='col'>Dano.Evoc:<br> <div class='item-comum'>{{$skill->dano_evoc}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Critico:<br> <div class='item-comum'>{{$skill->critico}}</div></th>
                                <th class='poder' scope='col'>Esquiva:<br> <div class='item-comum'>{{$skill->esquiva}}</div></th>
                                <th class='poder' scope='col'>Bloqueio:<br> <div class='item-comum'>{{$skill->bloqueio}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Defesa:<br> <div class='item-comum'>{{$skill->defesa}}</div></th>
                                <th class='poder' scope='col'>Resistencia:<br> <div class='item-comum'>{{$skill->resistencia}}</div></th>
                                <th class='poder' scope='col'>HP:<br> <div class='item-comum'>{{$skill->hp}}</div></th>

                            </tr>

                             <tr>
                                <th class='poder' scope='col'>Cura:<br> <div class='item-comum'>{{$skill->cura}}</div></th>
                                <th class='poder' scope='col'>Expira:<br> <div class='item-comum'>{{$skill->expira}}</div></th>
                                 <th class='poder' scope='col'>Data Fim:<br> <div class='item-comum'>{{$skill->fim}}</div></th>

                            </tr>
                            </thead>
                            </table>"

                                             data-trigger="click"
                                             src="{{asset('img/skill/'.$skill->id_classe.'/'.$skill->avatar.'.png')}}">
                                        <p class="s-nome">{{$skill->nome}}</p>
                                        <p class="s-level">Lv: {{$skill->level}}/100</p>
                                        <p class="s-energia">C.Energia: {{$skill->energia}}</p>
                                        <p class="s-desc">{{$skill->descricao}}</p>
                                        <button disabled type="button" class="btn btn_skill_buy_disable">Aprendida
                                        </button>

                                    </div>

                                @endif--}}
                            @empty
                                <td class="t-status t-active"
                                    style="text-align: center"> {!! trans('site.none_f') !!} {!! trans('site.skill') !!} {!! trans('site.available') !!}
                                    ...
                                </td>


                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-skill-clan" role="tabpanel"
                             aria-labelledby="pills-skill-clan-tab">
                            @forelse($skill_clan as $skill)

                              {{--  @if (empty($skill->id_personagem))--}}
                                    <div class="skill-status">
                                        <img class="s-avatar-skill popover-itens-bag"
                                             data-html="true"
                                             data-placement="auto-right"
                                             data-title="Status da Skill:  <b class='color-orange'>{{$skill->nome}}</b>"
                                             data-content="<table class=' status-power'>
                            <thead>
                            <tr>
                                <th class='poder' scope='col'>Req.Level:<br> <div class='item-comum'>{!! $skill->reqlevel !!}</div></th>
                                <th class='poder' scope='col'>Req.Missao:<br> <div class='item-comum'>{{$skill->reqmissao}}</div></th>
                                <th class='poder' scope='col'>Req.Evento:<br> <div class='item-comum'>{{$skill->reqevento}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Dano.Fisico:<br> <div class='item-comum'>{{$skill->dano_fisico}}</div></th>
                                <th class='poder' scope='col'>Dano.Magico:<br> <div class='item-comum'>{{$skill->dano_magico}}</div></th>
                                <th class='poder' scope='col'>Dano.Evoc:<br> <div class='item-comum'>{{$skill->dano_evoc}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Critico:<br> <div class='item-comum'>{{$skill->critico}}</div></th>
                                <th class='poder' scope='col'>Esquiva:<br> <div class='item-comum'>{{$skill->esquiva}}</div></th>
                                <th class='poder' scope='col'>Bloqueio:<br> <div class='item-comum'>{{$skill->bloqueio}}</div></th>

                            </tr>

                            <tr>
                                <th class='poder' scope='col'>Defesa:<br> <div class='item-comum'>{{$skill->defesa}}</div></th>
                                <th class='poder' scope='col'>Resistencia:<br> <div class='item-comum'>{{$skill->resistencia}}</div></th>
                                <th class='poder' scope='col'>HP:<br> <div class='item-comum'>{{$skill->hp}}</div></th>

                            </tr>

                             <tr>
                                <th class='poder' scope='col'>Cura:<br> <div class='item-comum'>{{$skill->cura}}</div></th>
                                <th class='poder' scope='col'>Expira:<br> <div class='item-comum'>{{$skill->expira}}</div></th>
                                 <th class='poder' scope='col'>Data Fim:<br> <div class='item-comum'>{{$skill->fim}}</div></th>

                            </tr>
                            </thead>
                            </table>"

                                             data-trigger="click"
                                             src="{{asset('img/skill/'.$skill->id_classe.'/'.$skill->avatar.'.png')}}">
                                        <p class="s-nome">{{$skill->nome}}</p>
                                        <p class="s-level">Lv: {{$skill->level}}</p>
                                        <p class="s-energia">Cols: {{$skill->cols}}</p>
                                        <p class="s-desc">{{$skill->descricao}}</p>
                                        <button id="{{$skill->id}}" type="submit" class="btn btn_skill_buy">Aprender
                                        </button>

                                    </div>
                                {{--  @elseif ($skill->id_personagem == $id_personagem)
                                      <div class="skill-status print-cinza">
                                          <img class="s-avatar-skill popover-itens-bag"
                                               data-html="true"
                                               data-placement="auto-right"
                                               data-title="Status da Skill:  <b class='color-orange'>{{$skill->nome}}</b>"
                                               data-content="<table class=' status-power'>
                              <thead>
                              <tr>
                                  <th class='poder' scope='col'>Req.Level:<br> <div class='item-comum'>{!! $skill->reqlevel !!}</div></th>
                                  <th class='poder' scope='col'>Req.Missao:<br> <div class='item-comum'>{{$skill->reqmissao}}</div></th>
                                  <th class='poder' scope='col'>Req.Evento:<br> <div class='item-comum'>{{$skill->reqevento}}</div></th>

                              </tr>

                              <tr>
                                  <th class='poder' scope='col'>Dano.Fisico:<br> <div class='item-comum'>{{$skill->dano_fisico}}</div></th>
                                  <th class='poder' scope='col'>Dano.Magico:<br> <div class='item-comum'>{{$skill->dano_magico}}</div></th>
                                  <th class='poder' scope='col'>Dano.Evoc:<br> <div class='item-comum'>{{$skill->dano_evoc}}</div></th>

                              </tr>

                              <tr>
                                  <th class='poder' scope='col'>Critico:<br> <div class='item-comum'>{{$skill->critico}}</div></th>
                                  <th class='poder' scope='col'>Esquiva:<br> <div class='item-comum'>{{$skill->esquiva}}</div></th>
                                  <th class='poder' scope='col'>Bloqueio:<br> <div class='item-comum'>{{$skill->bloqueio}}</div></th>

                              </tr>

                              <tr>
                                  <th class='poder' scope='col'>Defesa:<br> <div class='item-comum'>{{$skill->defesa}}</div></th>
                                  <th class='poder' scope='col'>Resistencia:<br> <div class='item-comum'>{{$skill->resistencia}}</div></th>
                                  <th class='poder' scope='col'>HP:<br> <div class='item-comum'>{{$skill->hp}}</div></th>

                              </tr>

                               <tr>
                                  <th class='poder' scope='col'>Cura:<br> <div class='item-comum'>{{$skill->cura}}</div></th>
                                  <th class='poder' scope='col'>Expira:<br> <div class='item-comum'>{{$skill->expira}}</div></th>
                                   <th class='poder' scope='col'>Data Fim:<br> <div class='item-comum'>{{$skill->fim}}</div></th>

                              </tr>
                              </thead>
                              </table>"

                                               data-trigger="click"
                                               src="{{asset('img/skill/'.$skill->id_classe.'/'.$skill->avatar.'.png')}}">
                                          <p class="s-nome">{{$skill->nome}}</p>
                                          <p class="s-level">Lv: {{$skill->level}}/100</p>
                                          <p class="s-energia">C.Energia: {{$skill->energia}}</p>
                                          <p class="s-desc">{{$skill->descricao}}</p>
                                          <button disabled type="button" class="btn btn_skill_buy_disable">Aprendida
                                          </button>

                                      </div>

                                  @endif--}}

                            @empty
                                <td class="t-status t-active"
                                    style="text-align: center"> {!! trans('site.none_f') !!} {!! trans('site.skill') !!} {!! trans('site.available') !!}
                                    ...
                                </td>


                            @endforelse
                        </div>
                    </div>
                </div>


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