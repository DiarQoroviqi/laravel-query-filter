<?php

namespace Deviar\LaravelQueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, $filterClass = null): Builder
    {
        if (! property_exists($this, 'defaultFilters') && is_null($filterClass)) {
            throw new \Exception('please add default_filters property to the model');
        }

        $class = $filterClass ? app($filterClass) : app($this->defaultFilters);

        return $class->apply($query);
    }
}
