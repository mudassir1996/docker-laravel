<?php

namespace App\Console;

use App\Console\Commands\SendSms;
use App\Http\Controllers\CampaignController;
use App\Models\SmsCampaign;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // \App\Console\Commands\SendSms::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('sms:send')->dailyAt("14:17");


        $smsCampaigns = SmsCampaign::all();
        foreach ($smsCampaigns as $smsCampaign) {
            if ($smsCampaign->status == "active") {
                $frequency = $smsCampaign->schedule;
                $schedule->call(function () use ($smsCampaign) {
                    // $sms_text = str_replace("[outlet-name]", session('outlet_title'), $smsCampaign->sms_text);
                    // $sms_text = str_replace("[outlet-phone]", session('outlet_phone'), $smsCampaign->sms_text);
                    // $sms_text = str_replace("[outlet-address]", session('outlet_address'), $smsCampaign->sms_text);
                    // Log::alert($sms_text);
                    Log::alert(CampaignController::runCampaign($smsCampaign));
                })->$frequency();
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
