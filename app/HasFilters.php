<?php


namespace App;


use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{

    public function scopeFilter(Builder $builder, Filter $filter)
    {
        $filter->apply($builder);
    }
}
