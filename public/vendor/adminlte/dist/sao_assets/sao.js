setTimeout(function () {
    $('#alerta-time').fadeOut('fast');
}, 5000);

const URL_Tables = '/vendor/adminlte/dist/sao_assets/datatables';
$(function () {

    let total_pontos = parseInt($('#status_pontos').text());
    $("#btn_aplicar").attr("disabled", true);
    $('#avatar-select').val('');
    $('#for_input').val('');
    $('#int_input').val('');
    $('#agi_input').val('');
    $('#def_input').val('');
    $('#res_input').val('');
    $('#vit_input').val('');
    $('#esp_input').val('');
    $('#mag_input').val('');
    $('#evo_input').val('');
    $('#pontos_input').val('');

    $('.img-radio').click(function (e) {
        $('.img-radio').not(this).removeClass('active')
            .siblings('input').prop('checked', false)
            .siblings('.img-radio').css('opacity', '0.5');
        $(this).addClass('active')
            .siblings('input').prop('checked', true)
            .siblings('.img-radio').css('opacity', '1 ');
        $('#avatar-select').val($(this).attr("id"));
    });
    //inicio carregar popover
    $('.popover-avatar').webuiPopover();
    $('.popover-itens-bag').webuiPopover({style: 'inverse'});

    //fim carregar popover

    $('.botao-excluir').click(function () {

        let avatar_clicado = $(this).attr('id');
        let nome_personagem = avatar_clicado.substring(avatar_clicado.indexOf('-') + 1);
        let id_personagem = avatar_clicado.substring(0, avatar_clicado.indexOf('-'));
        $('#id-personagem').val(id_personagem);
        $('#personagem-excluir').html('<b>' + nome_personagem + '</b>');

    });
    let show_level = $('#ativa-level_up').text();
    if (show_level === 'on') {
        $('#modalLevelUp').modal('show');
    }

    $('.plus-status').click(function () {
        let id_clicado = $(this).attr("id");
        let id_retorno = id_clicado.substring(id_clicado.indexOf('_') + 1);
        let input_val = '#' + id_retorno + '_input';
        let div = '#' + id_retorno + '_news';
        let pontos = parseInt($('#status_pontos').text());
        let extra = parseInt($(div).text());
        let add = extra + 1;
        let pontos_restante = pontos - 1;
        if (pontos > 0) {
            $(input_val).val(add);
            $(div).text(add);
            $('#status_pontos').text(pontos_restante);
            $('#pontos_input').val(pontos_restante);

        }
        if (pontos_restante < total_pontos && pontos_restante > 0) {
            $("#btn_aplicar").attr("disabled", false);
            $("#btn_aplicar").removeClass('btn-secundary');
            $("#btn_aplicar").addClass('btn-primary');
        }


    });

    $('.minus-status').click(function () {
        let id_clicado = $(this).attr("id");
        let id_retorno = id_clicado.substring(id_clicado.indexOf('_') + 1);
        let input_val = '#' + id_retorno + '_input';
        let div = '#' + id_retorno + '_news';
        let pontos = parseInt($('#status_pontos').text());
        let extra = parseInt($(div).text());
        let add = extra - 1;
        let pontos_restante = pontos + 1;
        if (extra > 0) {
            $(input_val).val(add);
            $(div).text(add);
            $('#status_pontos').text(pontos_restante);
            $('#pontos_input').val(pontos_restante);

        }
        if (pontos_restante == total_pontos) {
            $("#btn_aplicar").attr("disabled", true);
            $("#btn_aplicar").removeClass('btn-primary');
            $("#btn_aplicar").addClass('btn-secundary');
        }


    });

    $('.plus-status').on('mousedown', function () {
        let id_div = $(this).attr("id");
        let div = '#' + id_div;
        intervalId = setInterval(mult_click, 100);

        $(document).on('mouseup', release);

        function mult_click() {
            $(div).trigger('click');
        }

        function release() {
            if (intervalId !== 0) {
                clearInterval(intervalId); // Limpa o intervalo registrado anteriormente
                intervalId = 0;
            }
        }

    });

    $('.minus-status').on('mousedown', function () {
        let id_div = $(this).attr("id");
        let div = '#' + id_div;
        intervalId = setInterval(mult_click, 100);

        $(document).on('mouseup', release);

        function mult_click() {
            $(div).trigger('click');
        }

        function release() {
            if (intervalId !== 0) {
                clearInterval(intervalId); // Limpa o intervalo registrado anteriormente
                intervalId = 0;
            }
        }

    });

    //equipar item com click direito do mouse pc
    $('.bag-click').mousedown(function (e) {
        if (e.button === 2) { //verifica se é o botão direito
            let id_clicado = $(this).attr("id");
            let img_modal = $(this).attr('src');
            let item_name = id_clicado.substring(id_clicado.indexOf('-') + 1);
            let id_bag = id_clicado.substring(0, id_clicado.indexOf('-'));
            $('#item-bag-select').text(item_name);
            $('#img-bag-modal').attr('src', img_modal);
            $('#id-bag').val(id_bag);
            $('#id-bag-venda').val(id_bag);
            $('#modalbag').modal('show');
        }
    });

    //equipar item com click + segurar 3seg+  mobile/pc
    $('.bag-click').taphold(function () {
        let id_clicado = $(this).attr("id");
        let img_modal = $(this).attr('src');
        let item_name = id_clicado.substring(id_clicado.indexOf('-') + 1);
        let id_bag = id_clicado.substring(0, id_clicado.indexOf('-'));
        $('#item-bag-select').text(item_name);
        $('#img-bag-modal').attr('src', img_modal);
        $('#id-bag').val(id_bag);
        $('#id-bag-venda').val(id_bag);
        $('#modalbag').modal('show');

    })
    //desequipa item com click direito do mouse pc
    $('.slot-click').mousedown(function (e) {
        if (e.button === 2) { //verifica se é o botão direito
            let id_clicado = $(this).attr("id");
            let img_modal = $(this).attr('src');
            let item_name = id_clicado.substring(id_clicado.indexOf('-') + 1);
            let id_bag = id_clicado.substring(0, id_clicado.indexOf('-'));
            $('#item-slot-select').text(item_name);
            $('#img-slot-modal').attr('src', img_modal);
            $('#id-slot').val(id_bag);
            $('#modalslot').modal('show');
        }
    });
    //equipar item com click + segurar 3seg+  mobile/pc
    $('.slot-click').taphold(function () {
        //verifica se é o botão direito
        let id_clicado = $(this).attr("id");
        let img_modal = $(this).attr('src');
        let item_name = id_clicado.substring(id_clicado.indexOf('-') + 1);
        let id_bag = id_clicado.substring(0, id_clicado.indexOf('-'));
        $('#item-slot-select').text(item_name);
        $('#img-slot-modal').attr('src', img_modal);
        $('#id-slot').val(id_bag);
        $('#modalslot').modal('show');

    });
    jQuery.datetimepicker.setLocale('pt-BR');
    $('.datetimepicker').datetimepicker({

        formatDate: 'Y/m/d'
    });


    /* $('#btn-venda').click(function () {
         $('#btn-venda2').click();
     });*/


});
$(document).ready(function () {

    $('#lista-noticias').DataTable({
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        },
        "order": [[4, 'desc'], [1, 'asc']],
        /*  "scrollX": true,*/

        responsive: true,

        /*  responsive: {
              details: {
                  type: 'column'
              }
          },
          columnDefs: [ {
              className: 'control',
              orderable: false,
              targets:   0
          } ],*/


    });

    $('#lista-itens').DataTable({
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "item _START_ até _END_ de _TOTAL_ itens",
            "sInfoEmpty": "item 0 até 0 de 0 itens",
            "sInfoFiltered": "(Total: _MAX_)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        },
        "order": [[2, 'asc'], [3, 'asc']],
        /*  "scrollX": true,*/

        responsive: true,


    });

    $('#lista-avatar').DataTable({
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        },
        "order": [[4, 'desc'], [1, 'asc']],
        /*  "scrollX": true,*/

        responsive: true,


    });
    $('#lista-quests').DataTable({
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "quest _START_ até _END_ de _TOTAL_ quests",
            "sInfoEmpty": "quest 0 até 0 de 0 quests",
            "sInfoFiltered": "(Total: _MAX_)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        },
        "order": [[2, 'asc'], [3, 'asc']],
        /*  "scrollX": true,*/

        responsive: true,


    });

    $('#img-item').change(function () {
        $('#uploadFile').val($(this).val());
    });

    $('.img-item-edit').change(function () {
        let id_clicado = $(this).attr("id");
        let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);
        $('#uploadFile-' + id_item).val($(this).val());
    });

    $('.img-avatar-edit').change(function () {
        let id_clicado = $(this).attr("id");
        let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);
        $('#uploadAvatar-' + id_item).val($(this).val());
    });

    $('.img-face-edit').change(function () {
        let id_clicado = $(this).attr("id");
        let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);
        $('#uploadFace-' + id_item).val($(this).val());
    });

    $('.img-select-edit').change(function () {
        let id_clicado = $(this).attr("id");
        let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);
        $('#uploadSelect-' + id_item).val($(this).val());
    });

    $('.img-avatar-create').change(function () {
        $('#uploadAvatar').val($(this).val());
    });

    $('.img-face-create').change(function () {
        $('#uploadFace').val($(this).val());
    });

    $('.img-select-create').change(function () {
        $('#uploadSelect').val($(this).val());
    });

   /* $("#element").introLoader({
        animation: {
            name: 'doubleLoader',
            options: {
                exitFx:'fadeOut',
                ease: "easeInOutCirc",
                style: 'black',
                delayBefore: 500,
                exitTime: 300,
                progbarTime: 700,
                progbarDelayAfter: 400
            }
        }
    });*/
    // Add slimscroll
    $(Selector.sidebar).slimScroll({
        height: ($(window).height() - $(Selector.mainHeader).height()) + 'px',
        color : 'rgba(0,0,0,0.2)',
        size  : '3px'
    })



});









