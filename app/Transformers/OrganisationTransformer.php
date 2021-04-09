<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Organisation;
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
        'owner',
    ];

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
            'trial_end' => $organisation->trial_end_timestamp,
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
