<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Builder;


class ModelFilterService {

    protected $query;
    protected $filters;

    public function __construct(Builder $query, array $filters)
    {
        $this->query = $query;
        $this->filters = $filters;
    }

    public function apply()
    {
        foreach ($this->filters as $filter) {
            $this->applyFilter($filter);
        }

        return $this->query;
    }

    protected function applyFilter($filter)
    {
        $field = $filter['fp_field_name'];
        $value = $filter['fp_value'];
        $criteria = $filter['fp_criteria'];
        $type = $filter['fp_type'];

        switch ($criteria) {
            case 'equals':
                $this->query->where($field, '=', $value);
                break;
            case 'like':
                $this->query->where($field, 'like', '%' . $value . '%');
                break;
            case 'in':
                $values = explode(',', $value);
                $this->query->whereIn($field, $values);
                break;
            // Add more criteria as needed
        }
    }

}
