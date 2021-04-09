<?php

declare(strict_types=1);

namespace App;


use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * @param Builder $builder
     * @param Filter $filter
     */
    public function scopeFilter(Builder $builder, Filter $filter): void
    {
        $filter->apply($builder);
    }
}
