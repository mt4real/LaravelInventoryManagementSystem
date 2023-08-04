<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Policies\AdminPolicy;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        
        Admin::class=>AdminPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $url= URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(20),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
            return (new MailMessage)
            ->subject(config('app.name').'|'.'User Email Verification')
                 ->line('Hello'.''.''.''. $notifiable->name.''.''.''.", You registered with this email".''.''.''. $notifiable->email)
                 ->action('Verify your Email using this link', $url)
                 ->line('Thanks for registered on'.''.config('app.name'));


        });


    }
}
