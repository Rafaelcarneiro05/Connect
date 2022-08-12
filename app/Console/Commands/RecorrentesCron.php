<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RecorrentesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recorrentes:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {




       /*$a = DB::table('recorrente')::where([['', '=', date('Y-m-d') ]])->get();

        foreach ($a as $recorrente => $value) {
            $recorrente->format('Y M d')
        };

        */
    }
}
