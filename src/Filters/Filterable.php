<?php

namespace Deviar\LaravelQueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, $filterClass = null): Builder
    {
        if (! property_exists($this, 'default_filters') && is_null($filterClass)) {
            throw new \Exception('please add default_filters property to the model');
        }

        $class = $filterClass ? app($filterClass) : app($this->default_filters);

        return $class->apply($query);
    }
}
