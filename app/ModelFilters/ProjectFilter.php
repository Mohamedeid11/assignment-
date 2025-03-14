<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProjectFilter extends ModelFilter
{
    public function name($value)
    {
        return $this->where('name', 'LIKE', "%{$value}%");
    }

    public function status($value)
    {
        return $this->where('status', $value);
    }

    /**
     * Generic filter for dynamic attributes.
     *
     * @param array $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filters(array $filter)
    {
        $operator       = $filter['operator'] ?? '=';
        $value          = $filter['department'];

        return $this->related('attributes', function ($query) use ($value, $operator) {
            $query->where('value', $operator, $value);
        });
    }

}
