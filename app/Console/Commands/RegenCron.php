<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegenCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regen:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Regen HP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       /* if (Auth::check()) {*/
            DB::table('personagems')
                ->whereRaw('personagems.vida < personagems.vida_m')
                ->increment('vida', '5');
            $this->info('Cron de regeneração de HP rodando com sucesso!!!');

       /* }*/
    }
}
