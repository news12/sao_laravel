<?php

namespace App\Http\Middleware;

use App\Repositories\PersonagemRepository;
use Closure;
use Illuminate\Support\Facades\Request;

class CheckStatusPersonagem
{
    protected $personagemRepository;
    private $situacao_personagem;

    public function __construct(
        PersonagemRepository $personagemRepository
    )
    {
        $this->personagemRepository = $personagemRepository;
    }

    public function handle($request, Closure $next)
    {
        //Pega a Rota atual logada
        $rota_atual = Request::path();

        $rota_perso = 'personagem';
        $rota_criar = 'showP';
        $status_personagem = $this->personagemRepository->personagem_status();
        foreach ($status_personagem as $status) {

            $this->situacao_personagem = $status->status;

        }
        if ($rota_atual !== $rota_perso && $rota_atual !== $rota_criar) {
            if ($this->situacao_personagem === 'banido' or $this->situacao_personagem === 'bloqueado') {
                // Redireciona o usuário para a página de login, com session flash "message"
                return redirect()
                    ->route('personagem')
                    ->with('error', 'esete personagem foi banido ou bloqueado, entre em contato com a nossa staff para mais detalhes');
            }
        }
        return $next($request);
    }
}
