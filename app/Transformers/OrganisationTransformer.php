<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Organisation;
use Carbon\Carbon;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class OrganisationTransformer
 * @package App\Transformers
 */
class OrganisationTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'owner'
    ];

    protected function dateToUtcTimestamp(?Carbon $date)
    {
        if (is_null($date)) {
            return null;
        }

        return  $date->utc()->timestamp;
    }

    /**
     * @param Organisation $organisation
     *
     * @return array
     */
    public function transform(Organisation $organisation): array
    {
        return [
            'id' => $organisation->id,
            'name' => $organisation->name,
            'subscribed' => $organisation->subscribed,
            'trial_end' => $this->dateToUtcTimestamp($organisation->trial_end)
        ];
    }

    /**
     * @param Organisation $organisation
     *
     * @return Item
     */
    public function includeOwner(Organisation $organisation): Item
    {
        return $this->item($organisation->owner, new UserTransformer());
    }
}
