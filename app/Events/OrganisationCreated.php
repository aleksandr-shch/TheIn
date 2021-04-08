<?php

namespace App\Events;

use App\Organisation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganisationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $organisation;

    /**
     * Create a new event instance.
     *
     * @param Organisation $organisation
     */
    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
    }

}
