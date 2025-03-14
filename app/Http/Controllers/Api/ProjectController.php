<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Project\ProjectFilterRequest;
use App\Http\Requests\Api\Project\StoreProjectRequest;
use App\Http\Requests\Api\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\BaseCrudService;

class ProjectController extends BaseApiController
{

    protected $crudService;

    public function __construct()
    {
        $this->crudService = new BaseCrudService(new Project(), ['attributes.attribute']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProjectFilterRequest $request)
    {
        try {
            $filters = [
                'name' => $request->name,
                'status' => $request->status,
            ];

            foreach ($request->except(['name', 'status']) as $attributeName => $value) {
                $filters[$attributeName] = ['department' => $value['department'] ?? null, 'operator' => $value['operator'] ?? null];
            }

            $projects = $this->crudService->getFilterData($filters);
            return $this->returnJSON(ProjectResource::collection($projects));
        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $data = $request->validated();

            $project = $this->crudService->store([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            if (isset($data['attributes'])) {
                foreach ($data['attributes'] as $attribute) {
                    $project->attributes()->create([
                        'attribute_id' => $attribute['attribute_id'],
                        'value' => $attribute['value'],
                    ]);
                }
            }

            return $this->returnJSON(new ProjectResource($project));

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
            $project = $this->crudService->getById($id);

            return new ProjectResource($project);

        }catch (\Exception $e) {
            return $this->returnWrong('No data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        try {
            $project = $this->crudService->update($id, $request->only(['name', 'status']));

            if (isset($data['attributes'])) {
                $project->attributes()->delete();

                foreach ($data['attributes'] as $attribute) {
                    $project->attributes()->create([
                        'attribute_id' => $attribute['attribute_id'],
                        'value' => $attribute['value'],
                    ]);
                }
            }

            return new ProjectResource($project);

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
