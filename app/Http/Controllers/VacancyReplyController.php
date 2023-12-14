<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyReplyRequest;
use App\Http\Services\VacancyReplyService;
use App\Models\VacancyReply;
use Illuminate\Http\Request;

class VacancyReplyController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $replies = VacancyReply::leftJoin('vacancies', 'vacancy_replies.vacancy_id', '=', 'vacancies.id')
            ->leftJoin('categories', 'vacancies.category_id', '=', 'categories.id')
            ->leftJoin('employment_types', 'vacancies.employment_type_id', '=', 'employment_types.id')
            ->leftJoin('c_v_s', 'vacancy_replies.cv_id', '=', 'c_v_s.id')
            ->leftJoin('users', 'c_v_s.user_id', '=', 'users.id')
            ->select(
                'vacancy_replies.id',
                'vacancy_replies.cv_id',
                'vacancy_replies.replied_at',
                'vacancy_replies.covering_letter',
                'vacancy_replies.deleted_at',
                'vacancies.id as vacancy_id',
                'vacancies.name as vacancy_name',
                'vacancies.salary',
                'categories.id as category_id',
                'categories.name as category_name',
                'employment_types.id as employment_type_id',
                'employment_types.name as employment_type_name',
                'vacancies.responsibility',
                'vacancies.requirements',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'c_v_s.id as cv_id',
                'c_v_s.cv_url'
            )
            ->get();

        $formattedReplies = [];

        foreach ($replies as $reply) {
            $formattedReplies[] = [
                'id' => $reply->id,
                'cv' => [
                    'id' => $reply->cv_id,
                    'user' => [
                        'id' => $reply->user_id,
                        'name' => $reply->user_name,
                        'email' => $reply->user_email,
                        // Добавьте другие необходимые поля пользователя
                    ],
                    'cv_url' => $reply->cv_url,
                ],
                'vacancy' => [
                    'id' => $reply->vacancy_id,
                    'name' => $reply->vacancy_name,
                    'salary' => $reply->salary,
                    'category' => [
                        'category_id' => $reply->category_id,
                        'category_name' => $reply->category_name,
                    ],
                    'employment_type' => [
                        'employment_type_id' => $reply->employment_type_id,
                        'employment_type_name' => $reply->employment_type_name,
                    ],
                    'responsibility' => $reply->responsibility,
                    'requirements' => $reply->requirements,
                ],
                'replied_at' => $reply->replied_at,
                'covering_letter' => $reply->covering_letter,
                'deleted_at' => $reply->deleted_at,
            ];
        }
        return $formattedReplies;
    }

    public function replyByVacancyId(Request $request)
    {
        $vacancy_id = $request->query('vacancy_id');
        $replies = VacancyReply::leftJoin('vacancies', 'vacancy_replies.vacancy_id', '=', 'vacancies.id')
            ->leftJoin('categories', 'vacancies.category_id', '=', 'categories.id')
            ->leftJoin('employment_types', 'vacancies.employment_type_id', '=', 'employment_types.id')
            ->leftJoin('c_v_s', 'vacancy_replies.cv_id', '=', 'c_v_s.id')
            ->leftJoin('users', 'c_v_s.user_id', '=', 'users.id')
            ->where('vacancy_id', '=', $vacancy_id)
            ->select(
                'vacancy_replies.id',
                'vacancy_replies.cv_id',
                'vacancy_replies.replied_at',
                'vacancy_replies.covering_letter',
                'vacancy_replies.deleted_at',
                'vacancies.id as vacancy_id',
                'vacancies.name as vacancy_name',
                'vacancies.salary',
                'categories.id as category_id',
                'categories.name as category_name',
                'employment_types.id as employment_type_id',
                'employment_types.name as employment_type_name',
                'vacancies.responsibility',
                'vacancies.requirements',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'c_v_s.id as cv_id',
                'c_v_s.cv_url'
            )
            ->get();

        $formattedReplies = [];

        foreach ($replies as $reply) {
            $formattedReplies[] = [
                'id' => $reply->id,
                'cv' => [
                    'id' => $reply->cv_id,
                    'user' => [
                        'id' => $reply->user_id,
                        'name' => $reply->user_name,
                        'email' => $reply->user_email,
                        // Добавьте другие необходимые поля пользователя
                    ],
                    'cv_url' => $reply->cv_url,
                ],
                'vacancy' => [
                    'id' => $reply->vacancy_id,
                    'name' => $reply->vacancy_name,
                    'salary' => $reply->salary,
                    'category' => [
                        'category_id' => $reply->category_id,
                        'category_name' => $reply->category_name,
                    ],
                    'employment_type' => [
                        'employment_type_id' => $reply->employment_type_id,
                        'employment_type_name' => $reply->employment_type_name,
                    ],
                    'responsibility' => $reply->responsibility,
                    'requirements' => $reply->requirements,
                ],
                'replied_at' => $reply->replied_at,
                'covering_letter' => $reply->covering_letter,
                'deleted_at' => $reply->deleted_at,
            ];
        }
        return $formattedReplies;
    }

    public function show($dataId)
    {
        $reply = VacancyReply::leftJoin('vacancies', 'vacancy_replies.vacancy_id', '=', 'vacancies.id')
            ->leftJoin('categories', 'vacancies.category_id', '=', 'categories.id')
            ->leftJoin('employment_types', 'vacancies.employment_type_id', '=', 'employment_types.id')
            ->leftJoin('c_v_s', 'vacancy_replies.cv_id', '=', 'c_v_s.id')
            ->leftJoin('users', 'c_v_s.user_id', '=', 'users.id')
            ->where('vacancy_replies.id', '=', $dataId)
            ->select(
                'vacancy_replies.id',
                'vacancy_replies.cv_id',
                'vacancy_replies.replied_at',
                'vacancy_replies.covering_letter',
                'vacancy_replies.deleted_at',
                'vacancies.id as vacancy_id',
                'vacancies.name as vacancy_name',
                'vacancies.salary',
                'categories.id as category_id',
                'categories.name as category_name',
                'employment_types.id as employment_type_id',
                'employment_types.name as employment_type_name',
                'vacancies.responsibility',
                'vacancies.requirements',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'c_v_s.id as cv_id',
                'c_v_s.cv_url'
            )
            ->first();

            $formattedReplies = [
                'id' => $reply->id,
                'cv' => [
                    'id' => $reply->cv_id,
                    'user' => [
                        'id' => $reply->user_id,
                        'name' => $reply->user_name,
                        'email' => $reply->user_email,
                        // Добавьте другие необходимые поля пользователя
                    ],
                    'cv_url' => $reply->cv_url,
                ],
                'vacancy' => [
                    'id' => $reply->vacancy_id,
                    'name' => $reply->vacancy_name,
                    'salary' => $reply->salary,
                    'category' => [
                        'category_id' => $reply->category_id,
                        'category_name' => $reply->category_name,
                    ],
                    'employment_type' => [
                        'employment_type_id' => $reply->employment_type_id,
                        'employment_type_name' => $reply->employment_type_name,
                    ],
                    'responsibility' => $reply->responsibility,
                    'requirements' => $reply->requirements,
                ],
                'replied_at' => $reply->replied_at,
                'covering_letter' => $reply->covering_letter,
                'deleted_at' => $reply->deleted_at,
            ];
        return $formattedReplies;
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
        $data['replied_at'] = now();
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
