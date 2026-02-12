<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // blade email template
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            // nbr of minutes the token is valid
            $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

            return (new \Illuminate\Mail\Mailable())
                ->to($notifiable->getEmailForPasswordReset())
                ->subject('Réinitialisation de votre mot de passe — Smart Book Hub')
                ->view('emails.reset-password-email', [
                    'actionUrl' => $url,
                    'count'     => $count,
                ]);
        });
    }
}