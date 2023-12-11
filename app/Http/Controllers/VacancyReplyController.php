<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyReplyRequest;
use App\Http\Services\VacancyReplyService;
use App\Models\VacancyReply;
use Illuminate\Http\Request;

class VacancyReplyController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return VacancyReply::all();
    }

    public function show(VacancyReply $dataId)
    {
        return $dataId;
    }

    /**
     * @param VacancyReplyRequest $request
     * @param VacancyReplyService $service
     * @param VacancyReply $dataId
     * @return string[]
     */
    public function update(VacancyReplyRequest $request, VacancyReplyService $service, VacancyReply $dataId)
    {
        $updatedVacancyReply = $request->validated();
        if ($updatedVacancyReply) {
            return $service->update($dataId, $updatedVacancyReply);
        }
    }

    /**
     * @param VacancyReplyRequest $request
     * @return string[]
     */
    public function store(VacancyReplyRequest $request, VacancyReplyService $service)
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
        $data = VacancyReply::find($dataId);
        if ($data->delete()) {
            return 'successfully deleted';
        } else {
            return 'not deleted';
        }
    }
}
