<?php

declare(strict_types=1);

namespace App\Events;

use App\Organisation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrganisationCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var Organisation
     */
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
