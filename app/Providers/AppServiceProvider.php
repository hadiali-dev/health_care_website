<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.url') . '/reset-password/' . $token . '?email=' . urlencode($notifiable->email);
        });

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
