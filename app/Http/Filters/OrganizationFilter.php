<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class OrganizationFilter extends Filter
{
    protected const TYPE_SUBBED = 'subbed';
    protected const TYPE_TRIAL  = 'trial';

    protected function applyQuery(Builder $builder)
    {
        if ($this->value() === static::TYPE_SUBBED) {
            $builder->where('subscribed' ,'>=',1);
        }

        if ($this->value() === static::TYPE_TRIAL) {
            $builder->whereDate('trial_end', '>=', now());
        }
    }

    public function key(): string
    {
        return 'filter';
    }


}
