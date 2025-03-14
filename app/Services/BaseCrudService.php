<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;


class BaseCrudService
{
    protected Model $model;
    protected string $orderColumn;
    protected array $withRelations = [];

    public function __construct(Model $model, ?array $withRelations = [], ?string $orderColumn = 'created_at')
    {
        $this->model = $model;
        $this->orderColumn = $orderColumn;
        $this->withRelations = $withRelations;
    }

    public function getData()
    {
        $query = $this->model::orderBy($this->orderColumn, 'DESC');
        if (!empty($this->withRelations)) {
            $query->with($this->withRelations);
        }
        return $query->get();
    }

    public function getFilterData(?array $filters = [])
    {
        $query = $this->model::filter($filters ?? [])->orderBy($this->orderColumn, 'DESC');
        if (!empty($this->withRelations)) {
            $query->with($this->withRelations);
        }
        return $query->get();
    }

    public function store(array $data)
    {
        return $this->model::create($data);
    }

    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $record = $this->getById($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        $record = $this->getById($id);
        return $record->delete();
    }
}
