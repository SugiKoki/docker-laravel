<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Exceptions\BadRequestException;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;


use App\Models\Schedule;

class ScheduleDetailController extends Controller
{
    public function detail(int $id)
    {
        try{
            
            $schedule = Schedule::getScheduleByScheduleId($id)->first();
            if (is_null($schedule) || $schedule == 0) {
                return response()->json([
                    'success' => false,
                    'code' => 404,
                    'message' => "お探しのページが見つからなかったよ。"//$e,
                ], 404);
            }
            return response()->json([
                'success' => true,
                'code' => 200,
                'data' => 
                        [
                            'id' => $schedule->schedules_id,
                            'title' => $schedule->title,
                            'schedule_date' => $schedule->schedule_date,
                            'place' => $schedule->place,
                            'start_time' => $schedule->start_time,
                            'end_time' => $schedule->end_time,
                            'content' => $schedule->content,
                        ]
            ],200);
        }catch(Exception $e){
            throw new HttpResponseException(response()->json([
                'success' => false,
                'code' => 500,
                'message' => "問題が発生しちゃったよ"//$e,
            ], 500));
        }






        $schedule = Schedule::getScheduleByScheduleId($id)->first();
        if (is_null($schedule)) {
            throw new BadRequestException();
        }
        return view('schedule.schedule_detail', ['schedule' => $schedule]);
    }

    public function delete(Request $request)
    {
        Schedule::scheduleDelete($request->schedule_id);
        return redirect('/user/calendar');
    }
}
