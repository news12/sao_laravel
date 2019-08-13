<?php

namespace App\Http\Controllers;

use App\ClassDB\PersonagemClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $noticias_anuncios = DB::table('noticias')
            ->select('titulo','categoria','noticia','data')
            ->orderBy('data','desc')
            ->get();
        $rank_level = DB::table('personagems')
            ->select('nome','classe','personagems.level as level','exp','sigla')
            ->leftJoin('guilds','personagems.id_guild','=','guilds.id')
            ->join('classes','personagems.id_classe','=','classes.id')
            ->where('personagems.level','>','0')
            ->orderByDesc('level')
            ->orderByDesc('exp')
            ->limit(100)
            ->get();
        $posicao = 1;

        return view('home',compact('noticias_anuncios',
            'rank_level','posicao'));
    }
}
