<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmploymentTypeRequest;
use App\Http\Services\EmploymentTypeService;
use App\Models\EmploymentType;
use Illuminate\Http\Request;

class EmploymentTypeController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return EmploymentType::all();
    }

    public function show(EmploymentType $dataId)
    {
        return $dataId;
    }

    /**
     * @param EmploymentTypeRequest $request
     * @param EmploymentTypeService $service
     * @param EmploymentType $dataId
     * @return string[]
     */
    public function update(EmploymentTypeRequest $request, EmploymentTypeService $service, EmploymentType $dataId)
    {
        $updatedEmploymentType = $request->validated();
        if ($updatedEmploymentType) {
            return $service->update($dataId, $updatedEmploymentType);
        }
    }

    /**
     * @param EmploymentTypeRequest $request
     * @return string[]
     */
    public function store(EmploymentTypeRequest $request, EmploymentTypeService $service)
    {
        $data = $request->validated();
        if ($data) {
            return $service->store($data);
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($dataId)
    {
        $data = EmploymentType::find($dataId);
        if ($data->delete()) {
            return 'successfully deleted';
        } else {
            return 'not deleted';
        }
    }
}
