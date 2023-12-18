<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Http\Services\VacancyService;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $vacancies = Vacancy::leftJoin('categories', 'vacancies.category_id', '=', 'categories.id')
            ->leftJoin('employment_types', 'vacancies.employment_type_id', '=', 'employment_types.id')
            ->leftJoin('vacancy_replies', 'vacancies.id', '=', 'vacancy_replies.vacancy_id')
            ->leftJoin('c_v_s', 'c_v_s.id', '=', 'vacancy_replies.cv_id')
            ->select(
                'vacancies.id',
                'vacancies.name',
                'vacancies.salary',
                'vacancies.category_id',
                'categories.name AS category_name',
                'vacancies.employment_type_id',
                'employment_types.name AS employment_type_name',
                'vacancies.responsibility',
                'vacancies.requirements',
                'c_v_s.user_id AS user_id'
            )
            ->distinct()
        ->get();
//return $vacancies;
        $formattedVacancies  = [];
        foreach ($vacancies as $vacancy) {
            $formattedVacancies[] = [
                'id' => $vacancy->id,
                'name' => $vacancy->name,
                'salary' => $vacancy->salary,
                'category' => [
                    'category_id' => $vacancy->category_id,
                    'category_name' => $vacancy->category_name,
                ],
                'employment_type' => [
                    'employment_type_id' => $vacancy->employment_type_id,
                    'employment_type_name' => $vacancy->employment_type_name,
                ],
                'responsibility' =>$vacancy->responsibility,
                'requirements' =>$vacancy->requirements,
                'reply_status' => $vacancy->user_id == auth()->user()->id ? 1 : 0,
            ];
        }

        return $formattedVacancies;
    }

    public function show(Vacancy $dataId)
    {
        $vacancy = Vacancy::leftJoin('categories', 'vacancies.category_id', '=', 'categories.id')
            ->leftJoin('employment_types', 'vacancies.employment_type_id', '=', 'employment_types.id')
            ->where('vacancies.id', '=', $dataId['id'])
            ->select(
                'vacancies.id',
                'vacancies.name',
                'vacancies.salary',
                'vacancies.category_id',
                'categories.name AS category_name',
                'vacancies.employment_type_id',
                'employment_types.name AS employment_type_name',
                'vacancies.responsibility',
                'vacancies.requirements'
            )
            ->first();
            $formattedVacancy = [
                'id' => $vacancy->id,
                'name' => $vacancy->name,
                'salary' => $vacancy->salary,
                'category' => [
                    'category_id' => $vacancy->category_id,
                    'category_name' => $vacancy->category_name,
                ],
                'employment_type' => [
                    'employment_type_id' => $vacancy->employment_type_id,
                    'employment_type_name' => $vacancy->employment_type_name,
                ],
                'responsibility' =>$vacancy->responsibility,
                'requirements' =>$vacancy->requirements,

            ];

        return $formattedVacancy;
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
