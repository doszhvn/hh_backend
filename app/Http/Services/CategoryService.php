<?php

namespace App\Http\Services;

use App\Models\CV;

class CategoryService
{
    public function store($data)
    {
        if (CV::create($data)) {
            return ["message" => 'data created successful'];
        } else {
            return response()->json(["error" => 'data creating failed'], 500);
        }
    }

    public function update($dataId, $data)
    {
        if ($dataId->update($data)) {
            return ["message" => 'data updated successful'];
        } else {
            return response()->json(["error" => 'data updating failed'], 500);
        }
    }
}
