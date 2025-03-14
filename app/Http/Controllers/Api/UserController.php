<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\BaseCrudService;

class UserController extends BaseApiController
{
    protected $crudService;

    public function __construct()
    {
        $this->crudService = new BaseCrudService(new User(), ['projects', 'timesheets']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $users = $this->crudService->getData();
            return $this->returnJSON(UserResource::collection($users));

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();

            $user = $this->crudService->store($data);

            return $this->returnJSON(new UserResource($user));

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
            $user = $this->crudService->getById($id);

            return new UserResource($user);

        }catch (\Exception $e) {
            return $this->returnWrong('No data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = $this->crudService->update($id, $request->only(['name', 'type']));

            return new UserResource($user);

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
