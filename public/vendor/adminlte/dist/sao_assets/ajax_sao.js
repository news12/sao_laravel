$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});
const URL = '/';
//equipar item no personagem
$("#id-submit-bag").click(function (e) {

    e.preventDefault();
    let id_bag = $("input[name=id_bag]").val();


    $.ajax({

        type: 'POST',

        url: URL + 'equipBag',

        data: {id_bag: id_bag},
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('bag');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            $('#modalbag').hide();
            alert(erro);

        }

    });


});

//desequipar item no personagem
$("#id-submit-slot").click(function (e) {

    e.preventDefault();
    let id_slot = $("input[name=id_slot]").val();


    $.ajax({

        type: 'POST',

        url: URL + 'unequipBag',

        data: {id_slot: id_slot},
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('bag');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            $('#modalbag').hide();
            alert(erro);

        }

    });


});

//vender item da mochila
$("#btn-venda").click(function (e) {

    e.preventDefault();
    let id_bag = $("input[name=id_bag]").val();


    $.ajax({

        type: 'POST',

        url: URL + 'venderItemBag',

        data: {id_bag_venda: id_bag},
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('bag');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            $('#modalbag').hide();
            alert(erro);

        }

    });


});


//aprender habilidade
$(".btn_skill_buy").click(function (e) {

    e.preventDefault();
    /*  let id_skill = $("input[name=id_skill]").val();*/
    let id_skill = $(this).attr("id");

    $.ajax({

        type: 'POST',

        url: URL + 'cSkill',

        data: {

            id_skill: id_skill
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('skill');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});

//Ajax Panel Admin
$(".btn-save-noticia").click(function (e) {

    e.preventDefault();
    let id_clicado = $(this).attr("id");
    let id_noticia = id_clicado.substring(id_clicado.indexOf('-') + 1);
    let titulo = $('#titulo-' + id_noticia).val();
    let noticia = $('#noticia-' + id_noticia).val();
    let categoria = $('#categoria-' + id_noticia).val();
    let data = $('#data-' + id_noticia).val();

    $.ajax({

        type: 'POST',

        url: URL + 'aeNoticia',

        data: {

            id_noticia: id_noticia,
            titulo: titulo,
            noticia: noticia,
            categoria: categoria,
            data: data
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('alNoticia');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});

$(".btn-create-noticia").click(function (e) {

    e.preventDefault();
    let titulo = $('#titulo-criar').val();
    let noticia = $('#noticia-criar').val();
    let categoria = $('#categoria-criar').val();
    let data = $('#data-criar').val();

    $.ajax({

        type: 'POST',

        url: URL + 'acNoticia',

        data: {
            titulo: titulo,
            noticia: noticia,
            categoria: categoria,
            data: data
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('alNoticia');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});
$(".excluir-adm-noticia").click(function (e) {

    e.preventDefault();
    let id_clicado = $(this).attr("id");
    let id_noticia = id_clicado.substring(id_clicado.indexOf('-') + 1);

    $.ajax({

        type: 'POST',

        url: URL + 'adNoticia',

        data: {
            id_noticia: id_noticia
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('alNoticia');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});

$(".excluir-adm-item").click(function (e) {

    e.preventDefault();
    let id_clicado = $(this).attr("id");
    let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);

    $.ajax({

        type: 'POST',

        url: URL + 'adItem',

        data: {
            id_item: id_item
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('alItem');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});


/*$(".btn-save-item").click(function (e) {

    e.preventDefault();
    let id_clicado = $(this).attr("id");
    let id_item = id_clicado.substring(id_clicado.indexOf('-') + 1);
    let nome = $('#nome-' + id_item).val();
    let descricao = $('#descricao-' + id_item).val();
    let level = $('#level-' + id_item).val();
    let id_classe = $('#id-classe-' + id_item).val();
    let _for = $('#for-' + id_item).val();
    let _int = $('#int-' + id_item).val();
    let agi = $('#agi-' + id_item).val();
    let def = $('#def-' + id_item).val();
    let res = $('#res-' + id_item).val();
    let esp = $('#esp-' + id_item).val();
    let evo = $('#evo-' + id_item).val();
    let mag = $('#mag-' + id_item).val();
    let energia = $('#energia-' + id_item).val();
    let vida = $('#vida-' + id_item).val();
    let cols = $('#cols-' + id_item).val();
    let cash = $('#cash-' + id_item).val();
    let data_inicio = $('#data-inicio-' + id_item).val();
    let data_fim = $('#data-fim-' + id_item).val();
    let id_tipo_drop = $('#id-tipo-drop-' + id_item).val();
    let id_tipo_item = $('#id-tipo-item-' + id_item).val();
    let id_grau_item = $('#id-grau-item-' + id_item).val();
    let img_item = $('#img-item-' + id_item).val();
    let id_avatar = $('#id-avatar-' + id_item).val();
    $.ajax({

        type: 'POST',

        url: URL + 'aeItem',

        data: {
            id_item: id_item,
            nome: nome,
            descricao: descricao,
            level: level,
            id_classe: id_classe,
            for: _for,
            int: _int,
            agi: agi,
            def: def,
            res: res,
            esp: esp,
            evo: evo,
            mag: mag,
            energia: energia,
            vida: vida,
            cols: cols,
            cash: cash,
            data_inicio: data_inicio,
            data_fim: data_fim,
            id_tipo_drop: id_tipo_drop,
            id_tipo_item: id_tipo_item,
            id_grau_item: id_grau_item,
            id_avatar: id_avatar,
            img_item: img_item
        },
        dataType: 'json',
        cash: false,
        success: function () {
            location.replace('alItem');

        },
        error: function (result) {
            let erro = 'erro na requisição ajax' + result;
            alert(erro);

        }

    });


});*/
$('.btn-cancel-noticia').click(function () {
    window.location.replace(URL + "alNoticia");

});

$('.btn-cancel-avatar').click(function () {
    window.location.replace(URL + "alAvatar");

});

$('.btn-cancel-avatarlist').click(function () {
    window.location.replace(URL + "alAvatarList");

});

$('.btn-cancel-item').click(function () {
    window.location.replace(URL + "alItem");

});

$('.btn-cancel-quest').click(function () {
    window.location.replace(URL + "alQuest");

});

