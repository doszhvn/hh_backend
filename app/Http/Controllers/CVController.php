<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVRequest;
use App\Http\Services\CVService;
use App\Models\CV;
use Illuminate\Http\Request;

class CVController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return CV::where('user_id', auth()->user()->id)->get();
    }
    public function show(CV $dataId)
    {
        return $dataId;
    }

    /**
     * @param CVRequest $request
     * @param CVService $service
     * @param CV $dataId
     * @return string[]
     */
    public function update(CVRequest $request, CVService $service, CV $dataId)
    {
        $updatedCV = $request->validated();
        $updatedCV['user_id'] = auth()->user()->id;
        if ($updatedCV) {
            return $service->update($dataId, $updatedCV);
        }
    }

    /**
     * @param CVRequest $request
     * @return string[]
     */
    public function store(CVRequest $request, CVService $service)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
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
        $data = CV::find($dataId);
        if ($data->delete()) {
            return 'successfully deleted';
        } else {
            return 'not deleted';
        }
    }
}
