<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //rota visitante
    return view('welcome');
});
// Rotas autenticadas jogadores
$this->group(['middleware' => [
    'auth',
    'auth.unique.user',
    'verific.status.perso'
]], function () {

    //Rota Principal
    Route::get('/home', 'HomeController@index')
        ->name('home');

    //Rota Personagem
    Route::get('/personagem', 'PersonagemController@index')
        ->name('personagem');

    Route::post('/personagem', 'PersonagemController@store')
        ->name('personagem');

    Route::get('/showP', 'PersonagemController@show')
        ->name('showP');

    Route::post('/criarP', 'PersonagemController@create')
        ->name('criarP');

    Route::delete('/excluirP', 'PersonagemController@destroy')
        ->name('excluirP');

    Route::get('/statusP', 'PersonagemController@status')
        ->name('statusP');

    Route::post('/updateStatusP', 'PersonagemController@statusUpdate')
        ->name('updateStatusP');

    Route::get('/indexAvatar', 'PersonagemController@avatar')
        ->name('indexAvatar');

    Route::post('/updateAvatar', 'PersonagemController@updateAvatar')
        ->name('updateAvatar');

    //Rota Mochila
    Route::get('/bag', 'MochilaController@index')
        ->name('bag');

    Route::post('/equipBag', 'MochilaController@equipeItem')
        ->name('equipeBag');

    Route::post('/unequipBag', 'MochilaController@unequipeItem')
        ->name('unequipeBag');

    Route::post('/venderItemBag', 'MochilaController@venderItem')
        ->name('venderItemBag');

    //Rota Habilidade
    Route::get('/skill', 'SkillsController@index')
        ->name('skill');

    Route::post('/cSkill', 'SkillsController@buySkill')
        ->name('cSkill');

    //Rota Mapa
    Route::get('/andar', 'AndarsController@index')
        ->name('andar');

    Route::get('/mapa', 'AndarsController@mapa')
        ->name('mapa');

    Route::get('/resenha', 'AndarsController@resenha')
        ->name('resenha');

    Route::get('/dg', 'AndarsController@dg')
        ->name('dg');


});
//Rotas autenticadas + Painel Admin
$this->group(['middleware' => [
    'auth',
    'auth.unique.user',
    'auth.admin.user',
    'verific.status.perso'
]], function () {

    //Rotas Noticias
    Route::get('/alNoticia', 'NoticiasController@index')
        ->name('alNoticia');

    Route::post('/aeNoticia', 'NoticiasController@edit')
        ->name('aeNoticia');

    Route::post('/acNoticia', 'NoticiasController@create')
        ->name('acNoticia');

    Route::post('/adNoticia', 'NoticiasController@destroy')
        ->name('adNoticia');

    //Rotas Itens
    Route::get('/alItem', 'ItemsController@index')
        ->name('alItem');

    Route::post('/aeItem', 'ItemsController@edit')
        ->name('aeItem');

    Route::post('/acItem', 'ItemsController@create')
        ->name('acItem');

    Route::post('/adItem', 'ItemsController@destroy')
        ->name('adItem');

    //Rotas Avatars
    Route::get('/alAvatar', 'AvatarsController@index')
        ->name('alAvatar');

    Route::post('/aeAvatar', 'AvatarsController@edit')
        ->name('aeAvatar');

    Route::post('/acAvatar', 'AvatarsController@create')
        ->name('acAvatar');

    Route::post('/adAvatar', 'AvatarsController@destroy')
        ->name('adAvatar');

    Route::get('/alAvatarList', 'AvatarListsController@index')
        ->name('alAvatarList');

    Route::post('/aeAvatarList', 'AvatarListsController@edit')
        ->name('aeAvatarList');

    Route::post('/acAvatarList', 'AvatarListsController@create')
        ->name('acAvatarList');

    Route::post('/adAvatarList', 'AvatarListsController@destroy')
        ->name('adAvatarList');

    //Rotas Quests
    Route::get('/alQuest', 'QuestsController@index')
        ->name('alQuest');

    Route::post('/aeQuest', 'QuestsController@edit')
        ->name('aeQuest');

    Route::post('/acQuest', 'QuestsController@create')
        ->name('acQuest');

    Route::post('/adQuest', 'QuestsController@destroy')
        ->name('adQuest');

});

Auth::routes();



