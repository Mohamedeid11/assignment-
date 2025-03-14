<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Timesheet\StoreTimesheetRequest;
use App\Http\Requests\Api\Timesheet\UpdateTimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use App\Services\BaseCrudService;

class TimesheetController extends BaseApiController
{
    protected $crudService;

    public function __construct()
    {
        $this->crudService = new BaseCrudService(new Timesheet(), ['user','project']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $timeSheets = $this->crudService->getData();
            return $this->returnJSON(TimesheetResource::collection($timeSheets));

        }catch (\Exception $e) {
            return $this->returnWrong($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimesheetRequest $request)
    {
        try {
            $data = $request->validated();

            $timeSheet = $this->crudService->store($data);

            return $this->returnJSON(new TimesheetResource($timeSheet));

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
            $timeSheet = $this->crudService->getById($id);

            return new TimesheetResource($timeSheet);

        }catch (\Exception $e) {
            return $this->returnWrong('No data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimesheetRequest $request, string $id)
    {
        try {
            $timeSheet = $this->crudService->update($id, $request->only(['name', 'type']));

            return new TimesheetResource($timeSheet);

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
