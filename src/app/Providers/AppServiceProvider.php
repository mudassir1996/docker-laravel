<?php

namespace App\Providers;

use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        debugbar()->disable();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        config(['layout.self.rtl' => false]);
        // VerifyEmail::toMailUsing(function ($notifiable, $url) {

        //     if (!Auth::guard('employee')->check()) {
        //         $genericUrl = $url;
        //     } else if (Auth::guard('employee')->check()) {
        //         $verifyUrl = URL::temporarySignedRoute(
        //             'employee_verification.verify',
        //             Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
        //             [
        //                 'id' => $notifiable->getKey(),
        //                 'hash' => sha1($notifiable->getEmailForVerification()),
        //             ]
        //         );

        //         $genericUrl = $verifyUrl;
        //     }

        //     return (new MailMessage)->view('auth.verification_email', ['url' => $genericUrl]);
        // });
    }
}
