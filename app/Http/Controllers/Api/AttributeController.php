<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Attribute\StoreAttributeRequest;
use App\Http\Requests\Api\Attribute\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Services\BaseCrudService;

class AttributeController extends BaseApiController
{
    protected $crudService;

    public function __construct()
    {
        $this->crudService = new BaseCrudService(new Attribute(), ['values']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $attributes = $this->crudService->getData();
            return $this->returnJSON(AttributeResource::collection($attributes));

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        try {
            $data = $request->validated();

            $attribute = $this->crudService->store($data);

            return $this->returnJSON(new AttributeResource($attribute));

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $attribute = $this->crudService->getById($id);

            return new AttributeResource($attribute);

        }catch (\Exception $e) {
            return $this->returnWrong('No data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, string $id)
    {
        try {
            $attribute = $this->crudService->update($id, $request->only(['name', 'type']));

            return new AttributeResource($attribute);

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($id);

            return $this->returnSuccess();
        }catch (\Exception $e) {
            return $this->returnWrong('no data found');
        }
    }
}
