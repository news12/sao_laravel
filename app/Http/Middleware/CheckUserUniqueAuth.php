<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class CheckUserUniqueAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* Verifica se o valor da coluna/sessão "token_access" NÃO é compátivel com o valor da sessão que criamos quando o usuário fez login
        */
        if (auth()->user()->token_access != session()->get('access_token')) {
            // Faz o logout do usuário
            \Auth::logout();

            // Redireciona o usuário para a página de login, com session flash "message"
            return redirect()
                ->route('login')
                ->with('message', 'A sessão deste usuário está ativa em outro local!');
        }
        //Verifica informações de personagem da conta logada
        $personagem = DB::table('personagems')
                        ->where('conta','=',Auth::id())
                        ->get();
        //Pega a Rota atual logada
        $rota_atual = Request::path();
        //Rota de Criação de Personagem
        $rota_perso ='showP';
        $rota_criar = 'criarP';
        //Caso Não tenha nenhum personagem criado e esteja tentando ir para as outras rotas, será redirecionado
        if (($rota_atual !== $rota_perso && $rota_atual !== $rota_criar) && empty($personagem->count())) {
            $request->session()->flash('error', 'Favor criar pelo menos um personagem!!!');
            return redirect()
                 ->route('showP');

        }

        // Permite o acesso, continua a requisição
        return $next($request);
    }
}
