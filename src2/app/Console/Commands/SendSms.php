<?php

namespace App\Console\Commands;

use App\Classes\Sms;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        // $sms = new Sms();
        // $sms->send("923163203940", "hello", "fastsmsalerts");

        // Log::alert("running");
    }
}
