<?php

namespace Education\Console\Commands;

use Illuminate\Console\Command;
use Education\Entities\Voter;
use Education\Libraries\Sms\SendSMS;
use Log;

class Birthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar sms a las personas que cumplen años';

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
        $voters = Voter::votersBirthDay();
        $now = date('m-d');
        list($mounthNow, $dayNow) = explode('-', $now);
        $numbers = [];

        foreach ($voters as $count => $voter) {
            $number = [];
            list($year, $mounth, $day) = explode('-', $voter->date_of_birth);
            if ($mounth == $mounthNow && $day == $dayNow) {
                $number['telephone'] = $voter->telephone;
                $number['message'] = $voter->happy_birthday;
                array_push($numbers, $number);
                $this->info('Mensaje por enviar a '.$voter->telephone);
            }
        }

        $sendSMS = new SendSMS();
        $sendSMS->sendCustomMessages($numbers);

        Log::info('Mensajes de cumpleaños enviados. Cantidad: '.count($numbers));
        $this->info('OK');
    }
}
