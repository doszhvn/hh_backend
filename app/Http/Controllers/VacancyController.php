<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Http\Services\VacancyService;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Vacancy::all();
    }

    public function show(Vacancy $dataId)
    {
        return $dataId;
    }

    /**
     * @param VacancyRequest $request
     * @param VacancyService $service
     * @param Vacancy $dataId
     * @return string[]
     */
    public function update(VacancyRequest $request, VacancyService $service, Vacancy $dataId)
    {
        $updatedVacancy = $request->validated();
        if ($updatedVacancy) {
            return $service->update($dataId, $updatedVacancy);
        }
    }

    /**
     * @param VacancyRequest $request
     * @return string[]
     */
    public function store(VacancyRequest $request, VacancyService $service)
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
        $data = Vacancy::find($dataId);
        if ($data->delete()) {
            return 'successfully deleted';
        } else {
            return 'not deleted';
        }
    }
}
