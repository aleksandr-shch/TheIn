<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrganisationCreated;

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
    public function handle(OrganisationCreated $event): void
    {
        $event->organisation->owner->notify(
            new \App\Notifications\OrganisationCreated($event->organisation)
        );
    }
}
