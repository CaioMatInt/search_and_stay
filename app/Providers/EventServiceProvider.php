<?php

namespace App\Providers;

use App\Events\BookCreatedEvent;
use App\Events\BookDeletedEvent;
use App\Events\BookUpdatedEvent;
use App\Listeners\BookCreatedListener;
use App\Listeners\BookDeletedListener;
use App\Listeners\BookUpdatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BookCreatedEvent::class => [
            BookCreatedListener::class,
        ],
        BookUpdatedEvent::class => [
            BookUpdatedListener::class,
        ],
        BookDeletedEvent::class => [
            BookDeletedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
