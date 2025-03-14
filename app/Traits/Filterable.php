<?php

namespace App\Traits;

use App\Services\ModelFilterService;

trait Filterable
{
    public function scopeFilter($query, $filters)
    {
        return (new ModelFilterService($query, $filters))->apply();
    }
}
