<?php

declare(strict_types=1);

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class OrganisationFilter extends Filter
{
    protected const TYPE_SUBBED = 'subbed';
    protected const TYPE_TRIAL = 'trial';

    /**
     * @param Builder $builder
     * @return void
     */
    protected function applyQuery(Builder $builder): void
    {
        if ($this->value() === static::TYPE_SUBBED) {
            $builder->where('subscribed', '>=', 1);
        }

        if ($this->value() === static::TYPE_TRIAL) {
            $builder->whereDate('trial_end', '>=', now());
        }
    }

    /**
     * @return string
     */
    public function key(): string
    {
        return 'filter';
    }


}
