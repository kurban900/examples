<?php

namespace App\Providers;

use App\Events\FileIsUploaded;
use App\Events\ImportPartCompleted;
use App\Listeners\FileUploadedListener;
use App\Listeners\ImportPartListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FileIsUploaded::class => [
            FileUploadedListener::class,
        ],
        ImportPartCompleted::class => [
            ImportPartListener::class
        ]
    ];


    public function boot()
    {
    }
}
