<?php

namespace App\Listeners;

use App\Events\OrganisationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUserAboutNewOrganisation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrganisationCreated $event
     * @return void
     */
    public function handle(OrganisationCreated $event)
    {
        $event->organisation->owner->notify(
            new \App\Notifications\OrganisationCreated($event->organisation)
        );
    }
}
