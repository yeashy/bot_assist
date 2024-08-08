<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Company;
use App\Models\StaffMember;
use App\Observers\ClientObserver;
use App\Observers\CompanyObserver;
use App\Observers\StaffMemberObserver;
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
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Company::observe(CompanyObserver::class);
        Client::observe(ClientObserver::class);
        StaffMember::observe(StaffMemberObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
