<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AttributeValue\StoreAttributeValueRequest;
use App\Http\Requests\Api\AttributeValue\UpdateAttributeValueRequest;
use App\Http\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use App\Services\BaseCrudService;

class AttributeValuesController extends BaseApiController
{
    protected $crudService;

    public function __construct()
    {
        $this->crudService = new BaseCrudService(new AttributeValue(), ['attribute', 'entity']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $attributeValues = $this->crudService->getData();
            return $this->returnJSON(AttributeValueResource::collection($attributeValues));

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeValueRequest $request)
    {
        try {
            $data = $request->validated();

            $attributeValue = $this->crudService->store($data);

            return $this->returnJSON(new AttributeValueResource($attributeValue));

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
            $attributeValue = $this->crudService->getById($id);

            return new AttributeValueResource($attributeValue);

        }catch (\Exception $e) {
            return $this->returnWrong('No data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeValueRequest $request, string $id)
    {
        try {
            $attributeValue = $this->crudService->update($id, $request->only(['name', 'type']));

            return new AttributeValueResource($attributeValue);

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
