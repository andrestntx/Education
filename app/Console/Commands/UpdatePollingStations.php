<?php

namespace Education\Console\Commands;

use Illuminate\Console\Command;
use Education\Entities\Voter;
use Log;

class UpdatePollingStations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pollingstations:update {all=false} {take=10000} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Polling Stations';

    /**
     * Create a new command instance.
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
        $all = ($this->argument('all') === 'true');

        if ($all) {
            $voters = Voter::all();
        } else {
            $voters = Voter::whereNull('polling_station_id')
                ->take($this->argument('take'))
                ->get();
        }

        $this->output->progressStart(count($voters));

        Log::info('Inicio de Actualización de puestos de votación');

        foreach ($voters as $voter) {
            $result = $voter->hasPollingStation($all);
            if ($result['status']) {
                $pollingStation = $result['polling_station'];
                $voter->polling_station_id = $pollingStation->id;
                $voter->table_number = $result['table_number'];
                $voter->save();

                Log::info('Votante CC: '.$voter->doc.' - '.$voter->name.' actualizado puesto de votación '.$pollingStation->name);
            } else {
                Log::info('Votante CC: '.$voter->doc.' - '.$voter->name.' '.$result['message']);
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        Log::info('FIN de Actualización de puestos de votación');
    }
}
