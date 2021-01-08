<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CalendarRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use CreateUsersTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditScheduleController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function put(EditScheduleRequest $request,int $schedule_id)
    {

        try {
            $schedule = Schedule::editschedule([
                'schedule_id' => $schedule_id,
                'schedule_date' => $request->schedule_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'place' => $request->place,
                'title' => $request->title,
                'content' => $request->content,
            ]);
            return response()->json([
                'success' => true,
                'code' => 200,
                'data' =>
                [
                    'id' => $schedule->schedule_id,
                    'title' => $schedule->title,
                    'schedule_date' => $schedule->schedule_date,
                    'place' => $schedule->place,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'content' => $schedule->content,
                ]
            ], 200);
        } catch (Exception $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'code' => 500,
                'message' => 'エラーが発生したよ',
            ], 500));
        }
    }
}
